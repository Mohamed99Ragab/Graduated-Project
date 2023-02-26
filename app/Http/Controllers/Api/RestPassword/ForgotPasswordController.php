<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponseJson;
use App\Mail\SendCodeResetPasswordMail;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use HttpResponseJson;

    public function __invoke(Request $request)
    {

        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        $messages = [
            'email.required' => 'يرجي ادخال الايميل الخاص بحسابك',
            'email.email'=>'يجب ان يكون هذا الحقل ايميل',
            'email.exists'=>'عذرا هذا الايميل غير موجود له حساب'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }



        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create([
            'email'=>$request->email,
            'code'=>$data['code']
        ]);

        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPasswordMail($codeData->code));

        return $this->responseJson(null,'يرجى التحقق من بريدك الإلكتروني ، فنحن نرسل رمز التحقق',true);
    }
}
