<?php

namespace GW2Heroes\Http\Controllers;


use GW2Heroes\Models\Account;
use GW2Heroes\Models\User;
use GW2Treasures\GW2Api\GW2Api;
use GW2Treasures\GW2Api\V2\Authentication\Exception\AuthenticationException;
use Illuminate\Http\Request;

class AdminController extends Controller {
    function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        $this->authorize('admin');

        return redirect(action('AdminController@getUsers'));
    }

    public function getUsers() {
        $this->authorize('admin');

        $users = User::all();

        return view('admin.users')->with(compact('users'));
    }

    public function getAccounts() {
        $this->authorize('admin');

        $accounts = Account::all();

        return view('admin.accounts')->with(compact('accounts'));
    }

    public function postValidateApiKey(Request $request, GW2Api $api) {
        $this->authorize('admin');

        $account = Account::find($request->request->get('account'));

        $isValid = true;

        try {
            $api->tokeninfo($account->api_key_valid)->get();
        } catch(AuthenticationException $x) {
            $isValid = false;
        }

        if($isValid) {
            $account->api_key_valid = true;
            $account->save();

            return redirect(action('AdminController@getAccounts'));
        }

        return redirect(action('AdminController@getAccounts'))->withErrors('The API Key for account '.$account->id.' is still invalid');
    }
}
