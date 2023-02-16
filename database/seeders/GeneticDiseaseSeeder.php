<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneticDiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genetic_diseases')->delete();

        $genetic_diseases = [
            'متلازمة داون',
            'تأخر التطور والنمو الذهني',
            'التوحد',
            'خلل في التنسج الهيكلي وفشل النمو',
            'الاضطرابات الاستقلابية',
            'اضطرابات الميتوكوندريا',
            'السرطانات الوراثية العائلية',
            'ضعف السمع الوراثي ',
            'التليف الكيسي',
            'أمراض العيون',
            'مرض هنتنجتون',
            'الثلاسيميا',
            'مرض تاي ساكس',
            'متلازمة نونان',
            'الخصية المعلقة'

        ];

        foreach ($genetic_diseases as $disease){


            DB::table('genetic_diseases')->insert([
                'disease' => trim($disease)
            ]);
        }

    }
}
