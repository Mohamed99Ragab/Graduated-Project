<?php

namespace App\Http\Controllers\Api\RestPassword;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponseJson;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeCheckController extends Controller
{

    use HttpResponseJson;

    public function __invoke(Request $request)
    {


        $rules = [
            'code' => 'required|string|exists:reset_code_passwords,code',
        ];

        $messages = [
            'code.required' => 'يرجي ادخال الكود المرسل على الايميل اولا',
            'code.exists'=>'هذا الكود غير صحيح'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors(),false);
        }






        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {

            $passwordReset->delete();

            return $this->responseJson(null,'انتهت صلاحية رمز التحقق',false);
        }


        return $this->responseJson(['code'=>$passwordReset->code],'رمز كود التحقق صالح',true);


    }
}
