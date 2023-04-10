<?php

namespace App\Http\Requests\MedicalTests;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalTestRequest extends FormRequest
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
            'lab_name'=>'required|string',
            'type'=>'required|string',
            'date'=>'required|date|date_format:Y-m-d',
            'file'=>'required|file|mimes:jpg,png,jpeg,pdf',
        ];
    }

    public function messages()
    {
        return [
            'lab_name.required'=>'يرجى ادخال اسم المعمل الخاص بالتحليل',
            'lab_name.string'=>'يرجى ادخال الاسم كنص وليس شيئا اخر',
            'type.required'=>'يرجى ادخال نوع التحليل',
            'date.required'=>'يرجى ادخال تاريخ التحليل',
            'file.required'=>'يرجى ارفاق صورة من التحليل او ارفاق مستند',
            'file.mimes'=>'image,pdf يجب ان يكون نوع الملف المرفق'
        ];
    }




}
