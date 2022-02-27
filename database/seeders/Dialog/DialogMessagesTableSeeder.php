<?php

namespace Database\Seeders\Dialog;

use App\Models\Dialog\Dialog;
use App\Models\Dialog\DialogMessage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DialogMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = DialogMessage::factory(100)->create();
    }
}
