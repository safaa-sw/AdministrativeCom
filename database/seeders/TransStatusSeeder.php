<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trans_statuses')->insert([
           [ 'status' => 'جارية'],
           [ 'status' => 'مغلقة'],

        ]);
    }
}
