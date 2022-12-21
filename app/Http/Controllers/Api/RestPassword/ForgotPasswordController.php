<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPasswordMail;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);

        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPasswordMail($codeData->code));

        return response()->json(['message' => 'يرجى التحقق من بريدك الإلكتروني ، فنحن نرسل رمز التحقق'], 200);
    }
}
