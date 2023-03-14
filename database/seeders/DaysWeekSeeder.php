<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicine_days')->delete();

        $days = [
            'السبت',
            'الأحد',
            'الاثنين',
            'الثلاثاء',
            'الأربعاء',
            'الخميس',
            'الجمعة'
        ];


        foreach ($days as $day){
            DB::table('medicine_days')->insert([
                'day'=>trim($day)
            ]);
        }

    }
}
