<?php namespace GW2Heroes\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'GW2Heroes\Console\Commands\Update'
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
    }
}
