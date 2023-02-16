<?php

namespace App\Http\Requests\Teeth;

use Illuminate\Foundation\Http\FormRequest;

class TeethDevelopmentRequest extends FormRequest
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
            'teeth_name'=>'required|string',
            'apperance_date'=>'required|date|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'teeth_name.required'=>'يرجى تحديد السنة',
            'apperance_date.required'=>'يرجى تحديد تاريخ ظهور السنة',
            'apperance_date.date_format'=>'Y-m-d يجب ان يكون تاريخ ظهور السنة بنفس الصيغة',
            'apperance_date.date'=>'هذا التاريخ ليس صحيحا'
        ];
    }
}
