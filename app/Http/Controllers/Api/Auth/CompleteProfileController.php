<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\CompleteProfileRequest;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompleteProfileController extends Controller
{

    use HttpResponseJson;

    public function completeProfile(CompleteProfileRequest $request){




        $user = User::find(Auth::guard('api')->id());

        if(isset($user) & !empty($user)){


            $user->update([
                'birth_date'=>$request->birth_date,
                'gender'=>$request->gender
            ]);


            return $this->responseJson(null,'تم حفظ البيانات بنجاح',true);

        }
        else{

            return $this->responseJson(null,'يجب تسجيل الدخول اولا',false);


        }


    }


}
