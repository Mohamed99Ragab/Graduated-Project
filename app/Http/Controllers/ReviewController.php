<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponseJson;
use App\Models\Admin;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ReviewsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'message'=>'required|string'
        ];

        $messages = [
            'message.required' => 'يرجى كتابة رسالتك',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }




        $review = Review::create([
            'message'=>$request->message,
            'user_id'=>Auth::guard('api')->id()
        ]);

        $user = User::find(Auth::guard('api')->id());

        $admin = Admin::first();
        $admin->notify(new ReviewsNotification($user->name,$review->message));


        return $this->responseJson(null,'سوف يتم التواصل معك بخصوص المشكلة من قبل مسؤلى النظام',true);

    }
}
