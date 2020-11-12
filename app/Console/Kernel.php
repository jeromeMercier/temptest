<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
     protected $commands = [
   		\App\Console\Commands\SendNotificationMails::class,
   		\App\Console\Commands\SyncLDAPStudents::class,
   	];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sendnotificationmails --subscribed=instantly')->everyThirtyMinutes();
        $schedule->command('sendnotificationmails --subscribed=daily')->dailyAt('13:00');
        $schedule->command('sendnotificationmails --subscribed=weekly')->weeklyOn(1, '8:00');;
        $schedule->command('sendnotificationmails --subscribed=moderation')->weeklyOn(7, '8:00');;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected function dailyMail()
    {

    }
    protected function weeklyMail(){

    }
}
