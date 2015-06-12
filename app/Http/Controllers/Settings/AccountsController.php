<?php

namespace GW2Heroes\Http\Controllers\Settings;

use Auth;
use Crypt;
use GW2Heroes\Account;
use GW2Heroes\Http\Controllers\Controller;
use GW2Treasures\GW2Api\GW2Api;

class AccountsController extends Controller {
    function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        $accounts = Auth::user()->accounts()->with('characters')->get();

        return view('settings.accounts.index', compact('accounts'));
    }

    public function getVerify($id) {
        $account = Auth::user()->accounts()->find($id);

        if( !$account ) {
            return redirect( action( 'Settings\AccountsController@getIndex' ));
        }

        $key = $this->getVerificationKey( $account );

        return view('settings.accounts.verify', compact('account', 'key'));
    }

    public function postVerify($id) {
        $account = Auth::user()->accounts()->find($id);

        if( !$account ) {
            return redirect( action( 'Settings\AccountsController@getIndex' ));
        }

        $key = $this->getVerificationKey( $account );

        $api = new GW2Api();
        $tokeninfo = $api->tokeninfo( $account->api_key )->get();

        if( $tokeninfo->name === $key ) {
            $account->api_key_verified = true;
            $account->save();

            return redirect( action( 'Settings\AccountsController@getIndex' ));
        }

        return redirect( action('Settings\AccountsController@getVerify', [ $account->id ]) )
            ->withErrors('api_key', 'Name of API key does not match.');
    }

    protected function getVerificationKey( Account $account ) {
        return $key = 'gw2hero.es ' . substr(md5($account->api_key . config('app.key')), 0, 8);
    }
}
