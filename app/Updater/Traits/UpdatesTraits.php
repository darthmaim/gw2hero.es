<?php

namespace GW2Heroes\Updater\Traits;

use GW2Heroes\Updater\SchedulesUpdate;

trait UpdatesTraits {
    use SchedulesUpdate;

    public function scheduleTraitsUpdate() {
        $this->scheduleUpdate(TraitUpdater::class, null);
    }
}
