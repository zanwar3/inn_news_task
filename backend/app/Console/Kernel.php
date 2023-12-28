<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('news:scrape')
            ->hourlyAt(15)
            ->before(function () {
                Log::info('Starting news:scrape command...');
            })
            ->onSuccess(function () {
                Log::info('news:scrape command was successful.');
            })
            ->onFailure(function () {
                Log::error('news:scrape command failed.');
            });

        $schedule->command('news:index')
            ->hourlyAt(17)
            ->before(function () {
                Log::info('Starting news:index command...');
            })
            ->onSuccess(function () {
                Log::info('news:index command was successful.');
            })
            ->onFailure(function () {
                Log::error('news:index command failed.');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
