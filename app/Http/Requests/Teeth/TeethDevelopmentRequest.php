<?php

namespace App\Http\Requests\Teeth;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TeethDevelopmentRequest extends FormRequest
{
    use HttpResponseJson;


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
            'teeth_id'=>[
                'required','numeric',
                Rule::unique('teeth_developments')
                    ->where('user_id', Auth::guard('api')->id())
                ],
            'apperance_date'=>'required|date|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'teeth_id.required'=>'يرجى تحديد السنة',
            'teeth_id.unique'=>'لقد قمت بتسجيل هذة السنة مسبقا',
            'apperance_date.required'=>'يرجى تحديد تاريخ ظهور السنة',
            'apperance_date.date_format'=>'Y-m-d يجب ان يكون تاريخ ظهور السنة بنفس الصيغة',
            'apperance_date.date'=>'هذا التاريخ ليس صحيحا'
        ];
    }


}
