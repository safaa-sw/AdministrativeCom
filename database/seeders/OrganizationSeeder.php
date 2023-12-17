<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organizations')->insert([
            [
                'name' => 'ministry',
                'address' => 'syria',
                'mobile_no' => '986',
            ],
            [
                'name' => 'ministry comm',
                'address' => 'syria',
                'mobile_no' => '986',
            ],

        ]);
    }
}
