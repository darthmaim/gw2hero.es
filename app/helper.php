<?php

/**
 * Get the path to a versioned Elixir file.
 *
 * @param  string  $file
 * @return string
 */
function asset2($file)
{
    static $manifest = null;

    if (is_null($manifest) && file_exists(public_path('assets/rev-manifest.json'))) {
        $manifest = json_decode(file_get_contents(public_path('assets/rev-manifest.json')), true);
    }

    if (isset($manifest[$file])) {
        return asset('/assets/'.$manifest[$file]);
    } else {
        return asset('/assets/'.$file);
    }
}

