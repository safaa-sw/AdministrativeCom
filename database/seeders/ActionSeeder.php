<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->insert([
            [
                'name' => __('transaction.create'),
                'details' => 'create transaction details',
            ],
            [
                'name' => __('transaction.referr'),
                'details' => 'referr transaction details',
            ],
            [
                'name' => __('transaction.update'),
                'details' => 'update transaction details',
            ],
            [
                'name' => __('transaction.add-file'),
                'details' => 'add file transaction details',
            ],
            [
                'name' => __('transaction.update-file'),
                'details' => 'update-file transaction details',
            ],
            [
                'name' => __('transaction.show'),
                'details' => 'show transaction details',
            ],
            [
                'name' => __('transaction.connect'),
                'details' => 'connect transaction details',
            ],
            [
                'name' => __('transaction.give-opinion'),
                'details' => 'give opinion transaction details',
            ],
            [
                'name' => __('transaction.close'),
                'details' => 'close transaction details',
            ],
        ]);
    }
}
