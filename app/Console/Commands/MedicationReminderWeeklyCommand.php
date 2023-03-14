<?php

namespace App\Console\Commands;

use App\Models\MedicationReminder;
use App\Models\User;
use App\Notifications\MedicationReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MedicationReminderWeeklyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medicine:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command use to push notification to users to remember them time of medicine to take it weekly';

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

           $reminders = MedicationReminder::where('user_id',$user->id)->where('appointment','اسبوعيا')->get();

           foreach ($reminders as $reminder){
               if ($reminder->end_date > date_format(Carbon::now(),'Y-m-d')) {

                   $times = $reminder->medcineTimes;

                   foreach ($times as $time) {
                       $days = $time->medicinedays;

                       foreach ($days as $day) {
                           if ($day->day == Carbon::now()->dayName && date_format(Carbon::parse($time->time), 'h') == date_format(Carbon::now(), 'h')) {

                               $user->notify(new MedicationReminderNotification('تذكير موعد العلاج', " موعد اخذ الدواء " . $reminder->medicine_name . " الان"));
                           }
                       }
                   }
               }
            }


        }




    }
}
