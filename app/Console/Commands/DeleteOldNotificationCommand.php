<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:oldNotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command used to check notifications of user and check if date now if greater than created_at in 7 days or week , delete notification';

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

        $date_now = date_format(Carbon::now(),'Y-m-d');

        foreach ($users as $user){


            foreach ($user->unreadNotifications as $notification) {

                if( date_format(Carbon::parse($notification->created_at)->addDays(7),'Y-m-d') == $date_now ){

                    $notification->delete();



                }


            }

        }



    }
}
