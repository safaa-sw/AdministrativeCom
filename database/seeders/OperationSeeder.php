<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operations')->insert([
            [ 'name' => 'create transaction'],
            [ 'name' => 'referral transaction'],
 
         ]);
    }
}
