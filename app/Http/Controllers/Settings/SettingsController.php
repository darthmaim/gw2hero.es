<?php

namespace GW2Heroes\Http\Controllers\Settings;

use Illuminate\Http\Request;

use GW2Heroes\Http\Requests;
use GW2Heroes\Http\Controllers\Controller;

class SettingsController extends Controller {
    function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        return view('settings.settings');
    }
}
