<?php

namespace App\Http\Requests\AuthRequest;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class LoginReguest extends FormRequest
{
    use HttpResponseJson;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_or_phone' => 'required',
            'password' => 'required|string',
            'fcm_token'=>'required'
        ];
    }


    public function messages()
    {
        return [
            'email_or_phone.required'=>'يرجى ادخال رقم الموبيل او الايميل',
            'password.required'=>'يرجى ادخال كلمة المرور اولا',
            'fcm_token'=>'هذا الحقل مطلوب'

        ];
    }

//    public $validator = null;
//    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
//    {
//        $this->validator = $validator;
//    }


}
