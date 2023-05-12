<?php

namespace App\Console\Commands;

use App\Http\Traits\ChildTrait;
use App\Models\User;
use App\Notifications\growthNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class growthYearlyCommand extends Command
{
    use ChildTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'growth:yearly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command used to notify user to calc growth of child';

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

        foreach ($users as $user)
        {
            $ages = $this->calc_child_age($user->birth_date,date_format(Carbon::now(),'Y-m-d'));

            if($ages['years'] > 1 && $ages['years'] <= 5){

                $user->notify(new growthNotification('النمو','نذكركم بمعرفة نمو طفلك'));

            }



        }


    }
}
