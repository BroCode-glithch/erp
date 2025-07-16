<?php

namespace Database\Seeders;

use App\Models\Programs;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example of seeding programs
        // You can replace this with actual program data
        $programs = [
            ['name' => 'Computer Science'],
            ['name' => 'Business Administration'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Psychology'],
            ['name' => 'Biology'],
        ];

        foreach ($programs as $program) {
            Programs::create($program);
        }

        // output a message
        $this->command->info('Programs seeded successfully!');
    }
}
