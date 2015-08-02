<?php

namespace GW2Heroes\Http\Controllers\Settings;

use Auth;
use GW2Heroes\Account;
use GW2Heroes\Activity;
use GW2Heroes\Http\Controllers\Controller;
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
        $account = $this->createAccountFromNewApiKey($api, $apiKey);

        return redirect()->action('Settings\AccountsController@getIndex')
            ->with('account', $account);
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

        $requiredPermissions = ['account', 'characters'];

        foreach( $requiredPermissions as $permission ) {
            if( !in_array( $permission, $tokeninfo->permissions )) {
                return 'API key does not have `' . $permission . '` permission';
            }
        }

        return true;
    }

    /**
     * Creates a new account from an api key.
     *
     * @param GW2Api $api
     * @param string $apiKey
     * @return Account
     */
    protected function createAccountFromNewApiKey(GW2Api $api, $apiKey)
    {
        $account = Account::fromApiKey($apiKey);
        Auth::user()->accounts()->save($account);

        Activity::createForAccount($account, Activity::TYPE_ACCOUNT_CREATED);

        $characterInfos = $api->characters($apiKey)->all();
        $characters = [];

        foreach ($characterInfos as $char) {
            $characters[] = [
                'name' => $char->name,
                'race' => $char->race,
                'gender' => $char->gender,
                'profession' => $char->profession,
                'level' => $char->level
            ];
        }

        $account->characters()->createMany($characters);
        return $account;
    }
}
