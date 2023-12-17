<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('importances')->insert([
            [ 'name' => 'normal'],
            [ 'name' => 'important'],
            [ 'name' => 'very important'],
 
         ]);
    }
}
