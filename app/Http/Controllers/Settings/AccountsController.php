<?php

namespace GW2Heroes\Http\Controllers\Settings;

use Auth;
use GW2Heroes\Account;
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
        $accounts = Auth::user()->accounts()->with('characters')->get();

        return view('settings.accounts.index', compact('accounts'));
    }

    public function getAdd() {
        $apiKeyNameSessionName = $this->getApiKeyNameSessionName();

        if( Session::has($apiKeyNameSessionName) ) {
            $apiKeyName = Session::get($apiKeyNameSessionName);
        } else {
            $apiKeyName = 'gw2hero.es [' . str_random(8) . ']';
            Session::set($apiKeyNameSessionName, $apiKeyName);
        }

        return view('settings.accounts.add', compact('apiKeyName'));
    }

    public function postAdd(Request $request) {
        $this->validate($request, [
            'api_key' => 'required',
        ]);

        $apiKeyNameSessionName = $this->getApiKeyNameSessionName();
        $apiKeyName = Session::get($apiKeyNameSessionName);

        $apiKey = $request->input('api_key');

        $api = new GW2Api();

        try {
            $tokeninfo = $api->tokeninfo($apiKey)->get();
        } catch( AuthenticationException $e ) {
            return redirect()->back()
                ->withErrors('API key invalid');
        }

        if( $tokeninfo->name !== $apiKeyName ) {
            return redirect()->back()
                ->withErrors('API key name invalid');
        }

        if( !in_array('account', $tokeninfo->permissions) ) {
            return redirect()->back()
                ->withErrors('API key does not have `account` permission');
        }

        if( !in_array('characters', $tokeninfo->permissions) ) {
            return redirect()->back()
                ->withErrors('API key does not have `characters` permission');
        }

        Session::forget($apiKeyNameSessionName);

        $account = Account::fromApiKey($apiKey);
        Auth::user()->accounts()->save($account);

        $characterInfos = $api->characters( $apiKey )->all();
        $characters = [];

        foreach( $characterInfos as $char ) {
            $characters[] = [
                'name' => $char->name,
                'race' => $char->race,
                'gender' => $char->gender,
                'profession' => $char->profession,
                'level' => $char->level
            ];
        }

        $account->characters()->createMany($characters);

        return redirect()->action('Settings\AccountsController@getIndex')
            ->with('account', $account);
    }

    protected function getApiKeyNameSessionName() {
        return 'settings.accounts.add.apiKeyName';
    }
}
