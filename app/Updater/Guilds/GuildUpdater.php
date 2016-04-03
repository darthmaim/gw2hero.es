<?php

namespace GW2Heroes\Updater\Guilds;

use Carbon\Carbon;
use GW2Heroes\Models\Account;
use GW2Heroes\Models\Activity;
use GW2Heroes\Models\Character;
use GW2Heroes\Updater\Character\CharacterUpdatePayload;
use GW2Heroes\Updater\Character\UpdatesCharacter;
use GW2Heroes\Updater\Updater;
use GW2Treasures\GW2Api\V2\Authentication\Exception\AuthenticationException;
use Illuminate\Mail\Message;
use Illuminate\Support\Collection;
use Mail;

class GuildUpdater extends Updater {
    use UpdatesGuild;

    /**
     * @param GuildUpdatePayload $payload
     */
    protected function run($payload) {

    }
}
