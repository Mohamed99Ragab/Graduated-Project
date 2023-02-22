<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;

class LoginByGoogleFacebookRequest extends FormRequest
{
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
            'oauth_token'=>'required|string',
            'provider'=>'required|string|in:google,facebook',
            'fcm_token'=>'required'
        ];
    }



    public function messages()
    {
        return [
            'oauth_token.required'=>'يرجى ادخال oauth token',
            'provider.required'=>'يجب تحديد نوع التسجيل',
            'provider.in'=>'يجب ان يكون نوع التسجيل عن طريق google , facebook فقط',
            'fcm_token.required'=>'fcm token يرجي ادخال '
        ];
    }


    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }

}
