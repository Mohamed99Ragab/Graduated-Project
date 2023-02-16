<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkinDiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skin_diseases')->delete();


        $skin_diseases = [
            'لتهاب الجلد التأتبي (الإكزيما)',
            'الوحمات، الأورام الوعائية',
            'سرطانات الجلد',
            'الورم الميلانيني',
            'أمراض النسيج الضام للجلد',
            'التهاب الجلد التماسي',
            'جُلادات الحمل',
            'احمرار الأطراف',
            'تساقط الشعر',
            'التهابات في الجلد',
            'الاضطرابات الوراثية',
            'الشامات',
            'الصدفية',
            'التشوهات الوعائية',
            'الثآليل',
            'الحمامى السميه',
            'الإكزيما',
            'الحصف',
            'الجدري',
            'الحمى القرمزية',
            'القوباء الحلقية',
            'الشرى (الأرتكاريا)',
            'التهاب السحايا'


        ];


        foreach ($skin_diseases as $disease){

            DB::table('skin_diseases')->insert([
                'disease'=> trim($disease)
            ]);
        }

    }
}
