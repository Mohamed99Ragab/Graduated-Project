<?php

namespace App\Http\Requests\Reminder;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class MedicationReminderRequest extends FormRequest
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
            'medicine_name'=>'required|string|regex:/^[\p{Arabic} ]+$/u',
            'appointment'=>'required|string',
            'end_date'=>'required|date|date_format:Y-m-d|after:now',
            'mediceTimes.*.time'=>'required',
            'mediceTimes'=>'required|array',

        ];
    }


    public function messages()
    {
        return [
            'medicine_name.string'=>'يرجى ادخال اسم الدواء كنص وليس شيئا اخر',
            'medicine_name.required'=>'يرجى ادخال اسم الدواء',
            'medicine_name.regex'=>'يرجى ادخال اسم الدواء بالعربي فقط',
            'appointment.required'=>'يرجى تحديد حالة الدواء',
            'end_date.required'=>'يرجى تحديد تاريخ الانتهاء',
            'end_date.date_format'=>'Y-m-d يجب ان يكون التاريخ بنفس الصيغة',
            'end_date.date'=>'هذا التاريخ ليس صحيحا',
            'end_date.after'=>'يجب ان يكون تاريخ الانتهاء تاريخ مستقبلي',
            'mediceTimes.*.time.required'=>'يرجى تحديد الوقت الخاص بالدواء',
            'mediceTimes.array'=>'يرجى ارسال اوقات الدواء كمصفوفة',
            'mediceTimes.required'=>'يرجى تحديد اوقات الدواء',

        ];
    }


}
