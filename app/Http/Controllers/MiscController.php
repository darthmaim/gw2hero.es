<?php

namespace GW2Heroes\Http\Controllers;

class MiscController extends Controller {
    public function getOffline() {
        return view('errors.offline');
    }

    public function getServiceWorker() {
        return response(view('static.scripts.serviceworker'), 200, ['Content-Type' => 'application/javascript']);
    }
    
    public function getManifest() {
        return [
            "short_name" => "GW2Heroes",
            "name" => "GW2Heroes",
            "icons" => [[
                "src" => asset2('images/favicon-192x192.png'),
                "sizes" => "192x192",
                "type" => "image/png"
            ]],
            "start_url" => url("/?ref=homescreen"),
            "display" => "standalone",
            "theme_color" => "#B7000D",
            "background_color" => "#EEE"
        ];
    }
}
