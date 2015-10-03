<?php

namespace GW2Heroes\Http\Controllers\Settings;

use Auth;
use GW2Heroes\Models\Account;
use GW2Heroes\Models\Activity;
use GW2Heroes\Models\Character;
use GW2Heroes\Http\Controllers\Controller;
use GW2Heroes\Models\User;
use GW2Treasures\GW2Api\GW2Api;
use GW2Treasures\GW2Api\V2\Authentication\Exception\AuthenticationException;
use Illuminate\Http\Request;
use Session;

class AccountsController extends Controller {
    function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        $accounts = Auth::user()->accounts()->get();

        return view('settings.accounts.index', compact('accounts'));
    }

    public function getAdd() {
        $apiKeyName = $this->getApiKeyName();

        return view('settings.accounts.add', compact('apiKeyName'));
    }

    public function postAdd(Request $request) {
        $this->validate($request, [
            'api_key_name' => 'required',
            'api_key' => 'required',
        ]);

        $apiKeyName = $this->getApiKeyName();
        $apiKey = $request->input('api_key');

        $api = new GW2Api();

        // validate api key
        $apiKeyValidation = $this->validateApiKey( $api, $apiKey, $apiKeyName );
        if( $apiKeyValidation !== true ) {
            return redirect()->back()->withErrors($apiKeyValidation);
        }

        $this->forgetApiKeyName();

        // create the new account
        $user = Auth::user();
        $account = $this->createAccountFromNewApiKey($api, $apiKey, $user);

        if( !($account instanceof Account) ) {
            return redirect()->back()->withErrors($account);
        }

        // we redirect new users to /home to continue the tutorial.
        if( $user->accounts()->count() === 1 ) {
            return redirect()->action('HomeController@index')
                ->with('new_account', $account);
        }

        return redirect()->action('Settings\AccountsController@getIndex')
            ->with('new_account', $account);
    }

    public function getEdit($accountId) {
        $account = Auth::user()->accounts()->find( $accountId );
        $apiKeyName = $this->getApiKeyName();

        return view('settings.accounts.edit', compact('account', 'apiKeyName'));
    }

    public function postEdit($accountId, Request $request) {
        $this->validate($request, [
            'api_key_name' => 'required',
            'api_key' => 'required'
        ]);

        $account = Auth::user()->accounts()->find($accountId);

        $apiKeyName = $this->getApiKeyName();
        $apiKey = $request->input('api_key');

        $api = new GW2Api();

        // validate api key
        $apiKeyValidation = $this->validateApiKey( $api, $apiKey, $apiKeyName );
        if( $apiKeyValidation !== true ) {
            return redirect()->back()->withErrors($apiKeyValidation);
        }

        // get account id of the api key
        $accountId = $api->account($apiKey)->get()->id;

        // validate that the api key is for the same account we are trying to edit
        if( $account->guid !== $accountId ) {
            return redirect()->back()->withErrors('The API key is for the wrong account.');
        }

        // forget the api key name, next time we need a new one
        $this->forgetApiKeyName();

        // save the new api key
        $account->api_key = $apiKey;
        $account->api_key_valid = true;
        $account->save();

        return redirect()->action('Settings\AccountsController@getIndex')
            ->with('account', $account);
    }

    /**
     * Gets the current api key name or generates a new one.
     *
     * @return string
     */
    protected function getApiKeyName() {
        $apiKeyNameSessionName = $this->getApiKeyNameSessionName();

        if (Session::has($apiKeyNameSessionName)) {
            $apiKeyName = Session::get($apiKeyNameSessionName);
            return $apiKeyName;
        } else {
            $apiKeyName = 'gw2hero.es [' . str_random(8) . ']';
            Session::set($apiKeyNameSessionName, $apiKeyName);
            return $apiKeyName;
        }
    }

    /**
     * Removes the api key name from the session.
     */
    protected function forgetApiKeyName() {
        Session::forget( $this->getApiKeyNameSessionName() );
    }

    /**
     * Gets the name of the session variable that is holding the api key name.
     *
     * @return string
     */
    protected function getApiKeyNameSessionName() {
        return 'settings.accounts.add.apiKeyName';
    }

    /**
     * Validates a given new api key to match the required api key name and having the required scopes.
     *
     * @param GW2Api $api
     * @param string $apiKey
     * @param string $apiKeyName
     * @return true|string
     */
    protected function validateApiKey(GW2Api $api, $apiKey, $apiKeyName = null) {
        try {
            $tokeninfo = $api->tokeninfo($apiKey)->get();
        } catch( AuthenticationException $e ) {
            return 'API key invalid';
        }

        if( $tokeninfo->name !== $apiKeyName ) {
            return 'API key name invalid';
        }

        $requiredPermissions = ['account', 'characters', 'unlocks', 'builds'];

        foreach( $requiredPermissions as $permission ) {
            if( !in_array( $permission, $tokeninfo->permissions )) {
                return 'API key does not have `' . $permission . '` permission';
            }
        }

        return true;
    }

    /**
     * Creates a new account from an api key and imports all characters.
     *
     * @param GW2Api $api
     * @param string $apiKey
     * @param User   $user
     * @return Account
     */
    protected function createAccountFromNewApiKey(GW2Api $api, $apiKey, User $user) {
        $accountData = $api->account($apiKey)->get();

        // existing account
        /** @var Account $existingAccount */
        $existingAccount = Account::whereGuid($accountData->id)->first();
        if( !is_null( $existingAccount )) {
            if( $existingAccount->user_id === Auth::id() ) {
                return 'You already added the account '.$existingAccount->name.'.';
            } else {
                return 'The account '.$existingAccount->name.' is already linked to another user.
                    If you think this is an error and you are the legitimate owner of this account, please
                    contact our support.';
            }
        }

        $account = Account::createFromApiData($accountData, $apiKey, $user);
        Activity::accountCreated($account);

        // load characters from api
        $characterData = $api->characters($apiKey)->all();

        foreach($characterData as $char) {
            $character = Character::createFromApiData($char, $account);
            Activity::characterCreated($character);
        }

        return $account;
    }
}
