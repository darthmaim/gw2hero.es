<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Account;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

class AccountController extends Controller {

    protected function getAccountFromRequest( Request $request, $id, $function ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Account $account */
        $account = Cache::remember('account.'.$id, 1, function() use ($id) {
            return Account::with(['user', 'characters' => function($query) {
                return $query->orderBy('created', 'asc');
            }])->find($id);
        });

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

        return view('account.summary', compact('account'));
    }

    public function getCharacters( Request $request, $id ) {
        $account = $this->getAccountFromRequest( $request, $id, __FUNCTION__ );

        return view('account.characters', compact('account'));
    }

    public function getActivities( Request $request, $id ) {
        $account = $this->getAccountFromRequest( $request, $id, __FUNCTION__ );

        $activities = $account->activities()
            ->with('character', 'account', 'user', 'user.accounts')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.activities', compact('account', 'activities'));
    }
}
