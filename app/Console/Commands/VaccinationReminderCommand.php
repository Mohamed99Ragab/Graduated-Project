<?php

namespace App\Console\Commands;

use App\Http\Traits\ChildTrait;
use App\Models\User;
use App\Models\Vaccination;
use App\Notifications\VaccinationReminderNotification;
use App\Notifications\MedicationReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VaccinationReminderCommand extends Command
{
    use ChildTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command use to push notification to users to remember them vaccinations should take it in this age';

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

            if($user->is_reminder_vaccine == 1){


                //calc age of user in months
                $date_now = date_format(Carbon::now(),'Y-m-d');
                $birth_date = $user->birth_date;

                $ages = $this->calc_child_age($birth_date,$date_now);


                // this query to get vaccines that same age of user and user no take this vaccines
                // دا استعلام لجلب التطعيمات التى نفس الفترة العمرية للطفل و لم ياخدها الطفل حتى الان
                $vaccinations = Vaccination::where('vaccine_age',$ages['months'])->whereDoesntHave('users',function ($q)use($user){
                    return $q->where('user_id',$user->id);
                })->get();

                if(isset($vaccinations) & $vaccinations->count() >0){

                    foreach ($vaccinations as $vaccination){

                        $user->notify(new VaccinationReminderNotification('تذكير بمعياد اخذ التطعيمات',
                            "$user->name مرحبا ".' '.'نذكرك ميعاد اخذ'.' '.$vaccination->name.' '.'اليوم لطفلك'));
                    }
                }
            }

        }

//        return $this->info('vaccination reminder is send successfully');

    }
}
