<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $viewUsers    = Permission::firstOrCreate(['name' => 'view users']);
        $editUsers    = Permission::firstOrCreate(['name' => 'edit users']);
        $deleteUsers  = Permission::firstOrCreate(['name' => 'delete users']);
        $exportUsers = Permission::firstOrCreate(['name' => 'export users']);

        // Create roles
        $admin         = Role::firstOrCreate(['name' => 'admin']);
        $programManager= Role::firstOrCreate(['name' => 'program-manager']);
        $careSupport   = Role::firstOrCreate(['name' => 'care-support']);

        // Assign permissions to roles
        $admin->givePermissionTo([$viewUsers, $editUsers, $deleteUsers, $exportUsers]);
        $programManager->givePermissionTo($viewUsers, $exportUsers);
        $careSupport->givePermissionTo($viewUsers, $exportUsers);
    }
}
