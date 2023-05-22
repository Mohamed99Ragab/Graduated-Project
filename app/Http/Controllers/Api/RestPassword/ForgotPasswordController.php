<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponseJson;
use App\Mail\SendCodeResetPasswordMail;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Notifications\smsRestPasswordNotification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use HttpResponseJson;

    public function __invoke(Request $request)
    {


        if(is_numeric($request->email_or_phone)) {


            $rules = [
                'email_or_phone' => 'digits:11|exists:users,phone_number',
            ];

            $messages = [
                'email_or_phone.digits' => 'يجب ان يتكون رقم الموبيل من 11 رقم',
                'email_or_phone.exists' => 'هذا الرقم غير مسجل لدينا'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseJson(null, $validator->errors()->first(), false);
            }




            // Delete all old code that user send before.
            ResetCodePassword::where('email', $request->email_or_phone)->delete();

            // Generate random code
            $data['code'] = mt_rand(100000, 999999);

            // Create a new code
            $codeData = ResetCodePassword::create([
                'email'=>$request->email_or_phone,
                'code'=>$data['code']
            ]);

            // Send sms notification to user
            $this->sendSms($codeData->email,$codeData->code);


            return $this->responseJson(null,'لقد قمنا بارسال اليك كود على الموبيل',true);



        }
        else{

            $rules = [
                'email_or_phone' => 'email|exists:users,email',
            ];

            $messages = [
                'email_or_phone.email' => 'يجب ان يكون هذا الحقل من نوع ايميل',
                'email_or_phone.exists' => 'هذا الايميل غير مسجل من قبل',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return $this->responseJson(null, $validator->errors()->first(), false);
            }


            // Delete all old code that user send before.
            ResetCodePassword::where('email', $request->email_or_phone)->delete();

            // Generate random code
            $data['code'] = mt_rand(100000, 999999);

            // Create a new code
            $codeData = ResetCodePassword::create([
                'email'=>$request->email_or_phone,
                'code'=>$data['code']
            ]);

            // Send email to user
            Mail::to($codeData->email)->send(new SendCodeResetPasswordMail($codeData->code));

            return $this->responseJson(null,'يرجى التحقق من بريدك الإلكتروني ، فنحن نرسل رمز التحقق',true);
        }



    }




    public function sendSms($reciver_num,$code)
    {
        $accountSid = config('services.twilio')['account_sid'];
        $authToken = config('services.twilio')['auth_token'];
        $from = config('services.twilio')['from'];
        try
        {
            $client = new Client(['auth' => [$accountSid, $authToken]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
                ['form_params' => [
                    'Body' => "لقد تلقينا طلب استعادة كلمة المرور يمكنك استخدام هذا الكود: ".$code.' '.' لاستكمال عملية استعادة كلمة المرور مع العلم ان هذا الكود صالح لمدة ساعة فقط من وقت ارسال الرسالة', //set message body
                    'To' => "+2".$reciver_num,
                    'From' => $from //we get this number from twilio
                ]]);
            return $result;
        }
        catch (\Exception $e)
        {
            $this->responseJson(null,"Error: " . $e->getMessage(),false);
        }
    }




}
