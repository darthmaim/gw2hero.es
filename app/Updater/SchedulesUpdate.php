<?php

namespace GW2Heroes\Updater;

trait SchedulesUpdate {
    public abstract function scheduleUpdate($updater, UpdatePayload $payload);
}
