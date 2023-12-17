<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Importance;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            OrganizationSeeder::class,
            ActionSeeder::class,
            DepartmentSeeder::class,
            ImportanceSeeder::class,
            OperationSeeder::class,
            RoleSeeder::class,
            PrivilegeSeeder::class,
            SecretSeeder::class,
            TransStatusSeeder::class,
            TransTypeSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,       
        ]);
    }
}
