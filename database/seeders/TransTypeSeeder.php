<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trans_types')->insert([
            [
                'type' => 'inside',
                'name' => 'decision'
            ],
            [
                'type' => 'inside',
                'name' => 'vacation request'
            ],
            [
                'type' => 'incoming',
                'name' => 'incoming 1'
            ],
            [
                'type' => 'outgoing',
                'name' => 'outgoing 1'
            ],
            [
                'type' => 'outgoing',
                'name' => 'outgoing 2'
            ],
            

        ]);
    }
}
