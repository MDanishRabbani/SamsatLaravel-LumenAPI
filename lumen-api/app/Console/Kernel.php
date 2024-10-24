<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Illuminate\Foundation\Console\StorageLinkCommand::class,
    ];
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
    public function commands()
{
    $this->load(__DIR__.'/Commands');

    // Register storage link command
    $this->app->make('Illuminate\Foundation\Console\StorageLinkCommand')->setLaravel($this->app);
}

}
