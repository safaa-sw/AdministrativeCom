<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     *  
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'number' => '12/image',
            'subject' => 'decision',
            'trans_type_id' => 1,
            'secret_id' => 1,
            'importance_id' => 1,
            'trans_status_id' => 1,
            'user_id' => 1,
            'type_id'=>1,
            'type_type'=>'App\Models\Inside',
    
        ]);
    }
}
