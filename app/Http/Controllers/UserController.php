<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Models\User;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

class UserController extends Controller {

    protected function getUserFromRequest( Request $request, $id, $function ) {
        $id = base_convert( $id, 36, 10 );

        /** @var User $user */
        $user = Cache::remember('user.'.$id, 1, function() use ($id) {
            return User::with(['accounts'])->find($id);
        });

        $actionName = '\\'.__CLASS__.'@'.$function;
        $action = action( $actionName, $user->getActionData() );

        if( $action !== $request->url() ) {
            throw new HttpResponseException(
                redirect( $action, 301 )
            );
        }

        return $user;
    }

    public function getIndex( Request $request, $id ) {
        $user = $this->getUserFromRequest( $request, $id, __FUNCTION__ );

        return view('user.summary', compact('user'));
    }

    public function getAccounts( Request $request, $id ) {
        $user = $this->getUserFromRequest( $request, $id, __FUNCTION__ );

        return view('user.accounts', compact('user'));
    }

    public function getActivities( Request $request, $id ) {
        $user = $this->getUserFromRequest( $request, $id, __FUNCTION__ );

        $activities = $user->activities()
            ->with('character', 'account', 'user', 'user.accounts')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.activities', compact('user', 'activities'));
    }
}
