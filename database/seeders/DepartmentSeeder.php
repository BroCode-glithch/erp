<?php

namespace Database\Seeders;

use App\Models\Departments;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example of seeding departments
        // You can replace this with actual department data
        $departments = [
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
            ['name' => 'Sales'],
        ];

        foreach ($departments as $department) {
            Departments::create($department);
        }

        // output a message
        $this->command->info('Departments seeded successfully!');
    }
}
