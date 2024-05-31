<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $basicPermission = Permission::create(['name' => 'basic-plan-access']);
        $standardPermission = Permission::create(['name' => 'standard-plan-access']);
        $premiumPermission = Permission::create(['name' => 'premium-plan-access']);

        // Create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions to roles
//        $userRole->givePermissionTo($basicPermission, $standardPermission, $premiumPermission);
        $adminRole->givePermissionTo(Permission::all());
    }
}
