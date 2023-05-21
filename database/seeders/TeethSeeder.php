<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeethSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teeths')->delete();

        $teeths = [
            [
                'name'=>'قاطع مركزي علوي ايمن A',
                'month_start'=>6,
                'month_end'=>12
            ],
            [
                'name'=>'قاطع مركزي علوي ايسر A',
                'month_start'=>6,
                'month_end'=>12
            ],
            [
                'name'=>'قاطع مركزي سفلي ايسر A',
                'month_start'=>6,
                'month_end'=>12
            ],
            [
                'name'=>'قاطع مركزي سفلي ايمن A',
                'month_start'=>6,
                'month_end'=>12
            ],

            [
                'name'=>'قاطع جانبي علوي أيمن B',
                'month_start'=>9,
                'month_end'=>16
            ],
            [
                'name'=>'قاطع جانبي علوي ايسر B',
                'month_start'=>9,
                'month_end'=>16
            ],
            [
                'name'=>'قاطع جانبي سفلي أيمن B',
                'month_start'=>9,
                'month_end'=>16
            ],
            [
                'name'=>'قاطع جانبي سفلي ايسر B',
                'month_start'=>9,
                'month_end'=>16
            ],
            [
                'name'=>'ضرس أول علوي أيمن C',
                'month_start'=>13,
                'month_end'=>19
            ],
            [
                'name'=>'ضرس أول علوي أيسر C',
                'month_start'=>13,
                'month_end'=>19
            ],
            [
                'name'=>'ضرس أول سفلي أيمن C',
                'month_start'=>13,
                'month_end'=>19
            ],
            [
                'name'=>'ضرس أول سفلي ايسر C',
                'month_start'=>13,
                'month_end'=>19
            ],
            [
                'name'=>'ناب أول علوي أيمن D',
                'month_start'=>17,
                'month_end'=>23
            ],
            [
                'name'=>'ناب أول علوي ايسر D',
                'month_start'=>17,
                'month_end'=>23
            ],
            [
                'name'=>'ناب أول سفلي أيمن D',
                'month_start'=>17,
                'month_end'=>23
            ],
            [
                'name'=>'ناب أول سفلي ايسر D',
                'month_start'=>17,
                'month_end'=>23
            ],

            [
                'name'=>'ضرس ثاني علوي أيمن E',
                'month_start'=>23,
                'month_end'=>33
            ],
            [
                'name'=>'ضرس ثاني علوي ايسر E',
                'month_start'=>23,
                'month_end'=>33
            ],
            [
                'name'=>'ضرس ثاني سفلي أيمن E',
                'month_start'=>23,
                'month_end'=>33
            ],
            [
                'name'=>'ضرس ثاني سفلي ايسر E',
                'month_start'=>23,
                'month_end'=>33
            ],



        ];

        foreach ($teeths as $teeth){
            DB::table('teeths')->insert([

                'name'=>$teeth['name'],
                'month_start'=>$teeth['month_start'],
                'month_end'=>$teeth['month_end'],
            ]);
        }

    }
}
