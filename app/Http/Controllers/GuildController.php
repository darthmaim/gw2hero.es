<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Models\Guild;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

class GuildController extends Controller {

    protected function getGuildFromRequest( Request $request, $id, $function ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Guild $guild */
        $guild = Cache::remember('guild.'.$id, 1, function() use ($id) {
            return Guild::with('members')->find($id);
        });

        $actionName = '\\'.__CLASS__.'@'.$function;
        $action = action( $actionName, $guild->getActionData() );

        if( $action !== $request->url() ) {
            throw new HttpResponseException(
                redirect( $action, 301 )
            );
        }

        return $guild;
    }

    public function getIndex( Request $request, $id ) {
        $guild = $this->getGuildFromRequest( $request, $id, __FUNCTION__ );

        return view('guild.summary', compact('guild'));
    }
}
