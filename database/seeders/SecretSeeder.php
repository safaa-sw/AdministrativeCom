<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secrets')->insert([
            [ 'name' => 'normal'],
            [ 'name' => 'secret'],
            [ 'name' => 'very secret'],
 
         ]);
    }
}
