<?php namespace GW2Heroes\Http\Controllers;

use Auth;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        $activities = Auth::user()->activities()
            ->with('character', 'account', 'user', 'user.accounts')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $accounts = Auth::user()->accounts()
            ->with(['characters' => function($query) {
                return $query->orderBy('created', 'asc');
            }])
            ->get();

        return view('home', compact('activities', 'accounts'));
    }
}
