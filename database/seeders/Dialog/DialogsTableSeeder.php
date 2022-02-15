<?php

namespace Database\Seeders\Dialog;

use App\Models\Dialog\Dialog;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DialogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $data = [
            ['name' => 'ВАЗ 2101', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2102', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2103', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2104', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2105', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2106', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2107', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2108', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2109', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2110', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2111', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2112', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2113', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2114', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'ВАЗ 2115', 'created_at' => $date, 'updated_at' => $date],
        ];
        Dialog::insert($data);
    }
}
