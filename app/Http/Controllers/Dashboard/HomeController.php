<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){



        return view('dashboard.home');
    }


    public function read_all_notification(){

        $admin = Admin::first();
        $admin->unreadNotifications->markAsRead();

        return back();

    }

}
