<?php

namespace GW2Heroes\Updater\Guilds;

use GW2Heroes\Updater\SchedulesUpdate;

trait UpdatesGuild {
    use SchedulesUpdate;

    public function scheduleGuildUpdate(GuildUpdatePayload $payload) {
        $this->scheduleUpdate(GuildUpdater::class, $payload);
    }
}
