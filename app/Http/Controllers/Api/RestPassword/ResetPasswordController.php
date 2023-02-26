<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\RestPasswordRequest;
use App\Http\Traits\HttpResponseJson;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use HttpResponseJson;

    public function __invoke(RestPasswordRequest $request)
    {





        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return $this->responseJson(null,'انتهت صلاحية رمز التحقق',false);
        }

        // find user's email
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update([
            'password'=> Hash::make($request->password)
        ]);

        // delete current code
        $passwordReset->delete();

        return $this->responseJson(null,'تم إعادة تعيين كلمة المرور بنجاح',true);
    }
}
