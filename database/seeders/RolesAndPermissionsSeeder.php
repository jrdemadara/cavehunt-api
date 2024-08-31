<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $owner_permission = [
            'create apartment',
            'edit apartment',
            'delete apartment',
            'view own apartment',
            'respond to inquiries',
        ];

        $client_permission = [
            'search apartment',
            'view apartment',
            'contact owner',
        ];

        $admin_permission = [
            'manage users',
            'manage apartments',
            'view all apartments',
            'manage inquiries',
        ];

        foreach ($owner_permission as $permission) {
            Permission::create(['guard_name' => 'api', 'name' => $permission]);
        }

        foreach ($client_permission as $permission) {
            Permission::create(['guard_name' => 'api', 'name' => $permission]);
        }

        foreach ($admin_permission as $permission) {
            Permission::create(['guard_name' => 'web', 'name' => $permission]);
        }

        // Create roles and assign permissions
        $ownerRole = Role::create(['guard_name' => 'api', 'name' => 'owner']);
        $ownerRole->givePermissionTo([
            'create apartment',
            'edit apartment',
            'delete apartment',
            'view own apartment',
            'respond to inquiries',
        ]);

        $clientRole = Role::create(['guard_name' => 'api', 'name' => 'client']);
        $clientRole->givePermissionTo([
            'search apartment',
            'view apartment',
            'contact owner',
        ]);

        $adminRole = Role::create(['guard_name' => 'web', 'name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // // Optionally assign roles to specific users (adjust user IDs accordingly)
        // $adminUser = \App\Models\User::find(1); // Assuming user ID 1 is admin
        // if ($adminUser) {
        //     $adminUser->assignRole($adminRole);
        // }

        // $ownerUser = \App\Models\User::find(2); // Assuming user ID 2 is an owner
        // if ($ownerUser) {
        //     $ownerUser->assignRole($ownerRole);
        // }

        // $clientUser = \App\Models\User::find(3); // Assuming user ID 3 is a client
        // if ($clientUser) {
        //     $clientUser->assignRole($clientRole);
        // }
    }
}
