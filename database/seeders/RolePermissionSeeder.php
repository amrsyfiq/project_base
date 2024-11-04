<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            //Admin Settings
            ['name'  => 'view.admin', 'description'  => 'View Admin Settings', 'group'  => 'Admin'],

            //User
            ['name'  => 'view.user', 'description'  => 'View User', 'group'  => 'User'],
            ['name'  => 'create.user', 'description'  => 'Create User', 'group'  => 'User'],
            ['name'  => 'edit.user', 'description'  => 'Edit User', 'group'  => 'User'],
            ['name'  => 'delete.user', 'description'  => 'Delete User', 'group'  => 'User'],

            //Role
            ['name'  => 'view.role', 'description'  => 'View Role', 'group'  => 'Role'],
            ['name'  => 'create.role', 'description'  => 'Create Role', 'group'  => 'Role'],
            ['name'  => 'edit.role', 'description'  => 'Edit Role', 'group'  => 'Role'],
            ['name'  => 'delete.role', 'description'  => 'Delete Role', 'group'  => 'Role'],
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return [
                'name' => $permission['name'],
                'description' => $permission['description'],
                'guard_name' => 'web',
                'group' => $permission['group']
            ];
        });

        Permission::insert($permissions->toArray());

        $arrayOfRoleNames = [
            ['name'  => 'super-admin', 'description'  => 'Super Admin'],
            ['name'  => 'admin', 'description'  => 'Admin'],
            ['name'  => 'user', 'description'  => 'User'],
            ['name'  => 'visitor', 'description'  => 'Visitor'],
        ];

        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return [
                'name' => $role['name'],
                'description' => $role['description'],
                'guard_name' => 'web',
            ];
        });

        Role::insert($roles->toArray());

        $allPermission = Permission::all();
        $superAdmin = Role::where('name', 'super-admin')->first();

        $superAdmin->givePermissionTo($allPermission);
    }
}
