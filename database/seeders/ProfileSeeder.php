<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'image' => 'user image',
            'address' => 'syria-damas',
            'user_id' => 1,
    
        ]);
    }
}
