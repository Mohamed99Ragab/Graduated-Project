<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords,code',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response()->json(['message' => 'انتهت صلاحية رمز التحقق'], 422);
        }

        // find user's email
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update([
            'password'=> Hash::make($request->password)
        ]);

        // delete current code
        $passwordReset->delete();

        return response(['message' =>'تم إعادة تعيين كلمة المرور بنجاح'], 200);
    }
}
