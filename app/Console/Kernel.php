<?php

namespace App\Console;

use App\Console\Commands\MedicationReminderCommand;
use App\Console\Commands\MedicationReminderMonthlyCommand;
use App\Console\Commands\MedicationReminderWeeklyCommand;
use App\Console\Commands\TeethReminderCommand;
use App\Console\Commands\VaccinationReminderCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        MedicationReminderCommand::class,
        VaccinationReminderCommand::class,
        MedicationReminderWeeklyCommand::class,
        MedicationReminderMonthlyCommand::class,
        TeethReminderCommand::class,
    ];
    protected function schedule(Schedule $schedule)
    {

         $schedule->command('medicine:reminder')->everyMinute();
        $schedule->command('medicine:weekly')->hourly();
        $schedule->command('medicine:monthly')->daily();
        $schedule->command('vaccine:reminder')->daily();
        $schedule->command('teeth:reminder')->monthlyOn(5,'12:00');

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
}
