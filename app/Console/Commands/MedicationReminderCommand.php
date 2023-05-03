<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\VaccinationReminderNotification;
use App\Notifications\MedicationReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MedicationReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medicine:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command use to push notification to users to remember them time of medicine to take it';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user){

            foreach ($user->userTimes as $userTime){

                $reminder = $userTime->reminder;

                if ($reminder->end_date > date_format(Carbon::now(),'Y-m-d') && $reminder->appointment == "يوميا"){


                    if (date_format(Carbon::parse($userTime->time), 'h') == date_format(Carbon::now()->addHour(),'h')){

                        $user->notify(new MedicationReminderNotification('تذكير موعد العلاج'," موعد اخذ الدواء ".$reminder->medicine_name." الان"));
                    }


                }


            }


        }



    }
}
