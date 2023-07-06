<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponseJson;
use App\Mail\AdminContactUsEmail;
use App\Mail\userSupportMail;
use App\Models\Admin;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ReviewsNotification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    use HttpResponseJson;



    public function index(){


        $reviews = Review::latest()->get();

        return view('dashboard.reviews',compact('reviews'));
    }


    public function delete_review($id){


        Review::destroy($id);

        session()->flash('success','تم حذف المراجعة');
        return back();
    }


    public function reply_to_user_support(Request $request){


        $rules = [
            'message' => 'required',
        ];

        $messages = [
            'message.required' => 'يرجى ادخال ردك',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }



        if(isset($request->emailOfUser) && !empty($request->emailOfUser)){


           Mail::to($request->emailOfUser)->send(new userSupportMail($request->message));

           session()->flash('success','تم ارسال الرد الى المستخدم بنجاح');
            return back();
        }
        else{
          $this->sendSms($request->phoneOfUser,$request->message);
            session()->flash('success','تم ارسال الرد الى المستخدم بنجاح');
            return back();
        }




    }


    public function sendSms($reciver_num,$message)
    {
        $accountSid = config('services.twilio')['account_sid'];
        $authToken = config('services.twilio')['auth_token'];
        $from = config('services.twilio')['from'];
        try
        {
            $client = new Client(['auth' => [$accountSid, $authToken]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
                ['form_params' => [
                    'Body' => $message,//message body
                    'To' => "+2".$reciver_num,
                    'From' => $from //we get this number from twilio
                ]]);
            return $result;
        }
        catch (\Exception $e)
        {
            session()->flash('error',$e->getMessage());
        }
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

        // notify admin on email
        Mail::to($admin->email)->send(new AdminContactUsEmail($user,$review->message));


        return $this->responseJson(null,'سوف يتم التواصل معك بخصوص المشكلة من قبل مسؤلى النظام',true);

    }
}
