<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChronicDiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chronic_diseases')->delete();

        $chronic_diseases = [
            'الربو',
            'التهاب المفاصل الرثوانى',
            'الداء السكرى او مرض السكر',
            'المنغولية ومتلازمة داون',
            'الصلب او الشوك المشقوق',
            'الناعور',
            'سرطان الدم',
            'القصور او الفشل الكلوى',
            'الحثل او الضمور العضلى',
            'فقر الدم المنجلى او الانيميا المنجلية',
            'انشقاق او فلح الحنك او الشفة'
        ];

        foreach ($chronic_diseases as $disease){

            DB::table('chronic_diseases')->insert([
                'disease' => trim($disease)
            ]);
        }



    }
}
