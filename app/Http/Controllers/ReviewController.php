<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponseJson;
use App\Models\Admin;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ReviewsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use HttpResponseJson;



    public function index(){


        $reviews = Review::all();

        return view('dashboard.reviews',compact('reviews'));
    }


    public function delete_review($id){


        Review::destroy($id);

        session()->flash('success','تم حذف المراجعة');
        return back();
    }






    public function store(Request $request)
    {
        $request->validate([
            'review'=>'required|numeric'
        ]);

        $review = Review::create([
            'message'=>$request->message,
            'review'=>$request->review,
            'user_id'=>Auth::guard('api')->id()
        ]);

        $user = User::find(Auth::guard('api')->id());

        $admin = Admin::find(1);
        $admin->notify(new ReviewsNotification($user->name,$review->message));


        return $this->responseJson(null,'شكرا لاجل تقييمك من اجلنا',true);

    }
}
