<?php

namespace GW2Heroes\Updater\Specializations;

use GW2Heroes\Updater\SchedulesUpdate;

trait UpdatesSpecializations {
    use SchedulesUpdate;

    public function scheduleSpecializationsUpdate() {
        $this->scheduleUpdate(SpecializationUpdater::class, null);
    }
}
