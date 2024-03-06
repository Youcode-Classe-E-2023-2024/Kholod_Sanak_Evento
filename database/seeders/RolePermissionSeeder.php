<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $editorRole = Role::where('name', 'editor')->first();

        // Retrieve permissions
        $assignRolesPermission = Permission::where('name', 'assign roles')->first();
        $deleteUsersPermission = Permission::where('name', 'delete users')->first();
        $restoreUsersPermission = Permission::where('name', 'restore users')->first();
        $createTemplatesPermission = Permission::where('name', 'create templates')->first();
        $sendTemplatesPermission = Permission::where('name', 'send templates')->first();
        $trackTemplatesPermission = Permission::where('name', 'track templates')->first();
        $addMediasPermission = Permission::where('name', 'add medias')->first();
        $downloadUsersPermission = Permission::where('name', 'download users')->first();



        // Assign permissions to admin role
        $adminRole->givePermissionTo([
            $assignRolesPermission,
            $deleteUsersPermission,
            $restoreUsersPermission,
            $createTemplatesPermission,
            $sendTemplatesPermission,
            $trackTemplatesPermission,
            $addMediasPermission,
            $downloadUsersPermission,
            ]);

        $editorRole->givePermissionTo([
            $createTemplatesPermission,
            $sendTemplatesPermission,
            $trackTemplatesPermission,
            $addMediasPermission,
            $downloadUsersPermission,

        ]);
    }
}

