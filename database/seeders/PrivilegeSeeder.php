<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            [
                'role_id' => 1,
                'operation_id' => 1,
                'accept' => 1,
            ],
            [
                'role_id' => 1,
                'operation_id' => 2,
                'accept' => 1,
            ],
            [
                'role_id' => 2,
                'operation_id' => 1,
                'accept' => 0,
            ],
            [
                'role_id' => 2,
                'operation_id' => 2,
                'accept' => 1,
            ],


        ]);
    }
}
