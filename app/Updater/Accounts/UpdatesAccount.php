<?php

namespace GW2Heroes\Updater\Accounts;

use GW2Heroes\Updater\SchedulesUpdate;

trait UpdatesAccount {
    use SchedulesUpdate;

    public function scheduleAccountUpdate(AccountUpdatePayload $payload) {
        $this->scheduleUpdate(AccountUpdater::class, $payload);
    }
}
