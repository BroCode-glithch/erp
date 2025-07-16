<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call additional seeders
        $this->call([
            RolesSeeder::class,
            DepartmentSeeder::class,
            ProgramSeeder::class,
            SystemSettingsSeeder::class,
        ]);

        // Used createMany() to create multiple users at once
        User::factory()->createMany([
            [
                'name' => 'Admin',
                'email' => env('DEMO_ADMIN_EMAIL', 'emmaariyom1@gmail.com'),
                'password' => Hash::make(env('DEMO_ADMIN_PASSWORD', 'password')),
                'role' => 'admin',
            ],
            [
                'name' => 'Program Manager',
                'email' => env('DEMO_PM_EMAIL', 'emmaariyom@gmail.com'),
                'password' => Hash::make(env('DEMO_PM_PASSWORD', 'password')),
                'role' => 'program-manager',
            ],
            [
                'name' => 'Care Support',
                'email' => env('DEMO_CS_EMAIL', 'emmaariyom1@outlook.com'),
                'password' => Hash::make(env('DEMO_CS_PASSWORD', 'password')),
                'role' => 'care-support',
            ],
        ]);
    }
}
