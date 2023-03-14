<?php

namespace App\Console\Commands;

use App\Http\Traits\ChildTrait;
use App\Models\Teeth;
use App\Models\User;
use App\Notifications\TeethReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TeethReminderCommand extends Command
{
    use ChildTrait;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teeth:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to check age of child/user and compare with teeth appearance date and system will notify him';

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

        foreach ($users as $user) {

            $ages = $this->calc_child_age($user->birth_date,date_format(Carbon::now(),'Y-m-d'));


            $teethDevelopments = $user->teethDevelopments;

            if (isset($teethDevelopments)) {

                foreach ($teethDevelopments as $development){



                    $teeths = Teeth::whereDoesntHave('teethsDevelops',function ($q)use ($user){
                        $q->where('user_id',$user->id);
                    })->get();

                }

                if(isset($teeths) && $teeths->count() >0){


                    foreach ($teeths as $teeth){


                        if($ages['months'] >= $teeth->month_start && $ages['months'] <= $teeth->month_end)
                        {

                            $user->notify(new TeethReminderNotification('الأسنان','لطفلك ؟'.' '.$teeth->name.' '.'هل ظهرت السنة'));

                        }


                    }
                }






            }


        }



    }
}
