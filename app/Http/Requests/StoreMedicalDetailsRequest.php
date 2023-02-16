<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalDetailsRequest extends FormRequest
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
//            'user_id'=>'required',
            'blood_type'=>'required',
            'allergy'=>'required|max:255',
            'chronic_disease'=>'required|max:255',
            'skin_disease'=>'required|max:255'
        ];
    }


//    public function messages()
//    {
//        return [
//            'title.required' => 'A title is required',
//            'body.required' => 'A message is required',
//        ];
//    }

    public function attributes()
    {
        return [
            'blood_type' => 'فصيلة الدم',
            'allergy'=>'الحساسية',
            'chronic_disease'=>'الامراض المزمنة',
            'skin_disease'=>'امراض الجلدية'

        ];
    }
}
