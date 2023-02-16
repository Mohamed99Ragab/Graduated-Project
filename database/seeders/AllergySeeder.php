<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergies')->delete();


        $allergies = [
            'حساسية البيض',
            'حساسية الحليب',
            'حساسية الفول السوداني',
            'القمح',
            'الأسماك',
            'المحار',
            'الجوز',
            'الصويا',
            'حساسية الغبار',
            'حساسية  حشرية',
            'الربو الحساسي',
            'التهاب الأنف الحساسي (حمى القش)',
            'التهاب الملتحمة الحساسي (حالات حساسية العين)',
            'حالات حساسية الطعام',
            'لأرتيكاريا الحادة والمزمنة',
            'التهاب الجلد التأتبي والتماسي (الإكزيمة)',
            'الوذمة الوعائية الوراثية (التورم تحت الجلد)',
            'ضطرابات الخلايا اليوزينية',
            'التهاب الأمعاء والقولون الناجم عن بروتين الطعام (EPIES)'

        ];


        foreach ($allergies as $allergy){

            DB::table('allergies')->insert([
                'allergy'=>trim($allergy)
            ]);
        }

    }
}
