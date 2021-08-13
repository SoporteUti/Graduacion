<?php

namespace sispg\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Auth;
use sispg\Fecha;
use Carbon\Carbon;
use sispg\Utils\UtilFunctions;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function(){UtilFunctions::sendNotificationCalidadEgresado();})->everyMinute();
        $schedule->call(function(){UtilFunctions::sendNotificationPeriodoTesis();})->everyMinute();
        $schedule->call(function(){UtilFunctions::sendTiempoDefensa();})->everyMinute();
    }
}
