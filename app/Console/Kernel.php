<?php namespace GW2Heroes\Console;

use GW2Heroes\Updater\Items\ItemUpdater;
use GW2Heroes\Updater\Specializations\SpecializationUpdater;
use GW2Heroes\Updater\Traits\TraitUpdater;
use GW2Heroes\Updater\Updater;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Update::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        $schedule->command('gw2heroes:update')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->sendOutputTo(storage_path('logs/last-update.log'));

        $schedule->call(function() {
            $updater = new Updater();
            $updater->scheduleUpdate(ItemUpdater::class);
            $updater->scheduleUpdate(SpecializationUpdater::class);
            $updater->scheduleUpdate(TraitUpdater::class);
            $updater->queueScheduledUpdates();
        })->everyMinute();
    }
}
