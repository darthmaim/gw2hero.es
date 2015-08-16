<?php namespace GW2Heroes\Http\Controllers;

use GW2Heroes\Account;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

class AccountController extends Controller {

    protected function getAccountFromRequest( Request $request, $id, $function ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Account $account */
        $account = Account::with('user', 'characters')->find($id);

        $actionName = '\\'.__CLASS__.'@'.$function;
        $action = action( $actionName, $account->getActionData() );

        if( $action !== $request->url() ) {
            throw new HttpResponseException(
                redirect( $action, 301 )
            );
        }

        return $account;
    }

    public function getIndex( Request $request, $id ) {
        $account = $this->getAccountFromRequest( $request, $id, __FUNCTION__ );

        return view('account.index', compact('account'));
    }
}
