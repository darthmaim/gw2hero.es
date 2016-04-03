<?php

namespace GW2Heroes\Updater\Guilds;

use GW2Heroes\Models\Guild;
use GW2Heroes\Updater\UpdatePayload;

class GuildUpdatePayload extends UpdatePayload {
    /** @var Guild */
    public $guild;

    function __construct(Guild $guild) {
        $this->guild = $guild;
    }
}
