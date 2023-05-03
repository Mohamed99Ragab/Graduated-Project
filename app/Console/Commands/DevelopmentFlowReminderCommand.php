<?php

namespace App\Console\Commands;

use App\Http\Traits\ChildTrait;
use App\Models\Question;
use App\Models\User;
use App\Notifications\DevelopmentFollowNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DevelopmentFlowReminderCommand extends Command
{

    use ChildTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devflow:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to notify user if find any questions in devlopment flow same age of user';

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



        $users = User::get();

        foreach ($users as $user){

        //   get age of user
            $ages = $this->calc_child_age($user->birth_date,date_format(Carbon::now(),'Y-m-d'));



            $questions =   Question::where('age_stage',$ages['months'])->get();

            if (isset($questions) && $questions->count() > 0)
            {

                $user->notify(new DevelopmentFollowNotification('التطور',"هناك اسئلة مناسبة لنفس المرحلة العمرية الخاصة بك تصفحها الان"));

            }


        }







    }
}
