<?php

namespace App\Console;
date_default_timezone_set('America/Sao_Paulo');

use App\Http\Controllers\ProductsController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->command('schedule:run')->daily()->at('02:00');

    $schedule->call(function () {
        $controller = new ProductsController();
        $controller->dbregister();
    });
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
