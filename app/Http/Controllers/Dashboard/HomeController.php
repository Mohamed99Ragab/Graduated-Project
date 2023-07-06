<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AiDisease;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){


//       total of customer support this day
        $customer_support_count = Review::whereDay('created_at',date('d'))->get()->count();







//        query to calc count of users are registeration in this system in every month this year

        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('count', 'month_name');


        $labels = $users->keys();
        $data = $users->values();


//        query to calc how many child from every gender on the system
         $genderCount = User::select(DB::raw("COUNT(*) as count"),DB::raw("gender as gender"))
             ->groupBy('gender')
             ->pluck('count','gender');

         $gender_labels =  $genderCount->keys();
         $gender_count =  $genderCount->values();

//          query to calc numbers of users that predication of disease is 1 in every disease

         $diseases = AiDisease::select(DB::raw("COUNT(*) as count"), DB::raw("disease_name as disease_name"))
            ->where('prediction', 1)
            ->groupBy('disease_name')
            ->pluck('count', 'disease_name');

         $disease_labels =  $diseases->keys();
          $disease_count =  $diseases->values();

        // query to calc numbers of users that predication of disease is 0 in every disease

        $diseases_normal = AiDisease::select(DB::raw("COUNT(*) as count"), DB::raw("disease_name as disease_name"))
            ->where('prediction', 0)
            ->groupBy('disease_name')
            ->pluck('count', 'disease_name');

        $disease_normal_labels =  $diseases_normal->keys();
        $disease_normal_count =  $diseases_normal->values();









        return view('dashboard.home',compact(
            'labels',
            'data',
            'gender_labels',
            'gender_count',
            'disease_labels',
            'disease_count',
            'disease_normal_labels',
            'disease_normal_count',
            'customer_support_count'

        ));
    }


    public function read_all_notification(){

        $admin = Admin::first();
        $admin->unreadNotifications->markAsRead();

        return back();

    }

}
