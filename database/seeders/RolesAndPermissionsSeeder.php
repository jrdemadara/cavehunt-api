<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    protected static ?string $password;

    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
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

        // Create permissions if they do not exist
        foreach ($owner_permission as $permission) {
            if (!Permission::where('name', $permission)->where('guard_name', 'api')->exists()) {
                Permission::create(['guard_name' => 'api', 'name' => $permission]);
            }
        }

        foreach ($client_permission as $permission) {
            if (!Permission::where('name', $permission)->where('guard_name', 'api')->exists()) {
                Permission::create(['guard_name' => 'api', 'name' => $permission]);
            }
        }

        foreach ($admin_permission as $permission) {
            if (!Permission::where('name', $permission)->where('guard_name', 'web')->exists()) {
                Permission::create(['guard_name' => 'web', 'name' => $permission]);
            }
        }

        // Create roles and assign permissions
        $ownerRole = Role::firstOrCreate(['guard_name' => 'api', 'name' => 'owner']);
        $ownerRole->givePermissionTo($owner_permission);

        $clientRole = Role::firstOrCreate(['guard_name' => 'api', 'name' => 'client']);
        $clientRole->givePermissionTo($client_permission);

        $adminRole = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'admin']);
        $adminRole->givePermissionTo($admin_permission);

        $superAdminRole = Role::create(['name' => 'super admin']);

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@cavehunt.ph',
            'password' => static::$password ??= Hash::make('password'),
        ]);
        $user->assignRole($user);

        $user = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@cavehunt.ph',
            'password' => static::$password ??= Hash::make('password'),
        ]);
        $user->assignRole($superAdminRole);

        // Optionally assign roles to specific users (adjust user IDs accordingly)
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
