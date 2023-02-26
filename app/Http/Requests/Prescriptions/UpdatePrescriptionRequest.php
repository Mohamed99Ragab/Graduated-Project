<?php

namespace App\Http\Requests\Prescriptions;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionRequest extends FormRequest
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
            'note'=>'nullable|string',
            'date'=>'required|date|date_format:Y-m-d',
            'file'=>'mimes:mimes:jpg,png,jpeg,pdf',
        ];
    }

    public function messages()
    {
        return [
            'note.string'=>'يرجى ادخال الملاحظة كنص وليس شيئا اخر',
            'date.required'=>'يرجى ادخال تاريخ الروشتة',
            'file.mimes'=>' jpg,png,jpeg,pdf يجب ان يكون نوع الملف المرفق بهذة الصيغ فقط'
        ];
    }




}
