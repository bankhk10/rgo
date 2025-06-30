<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // สร้าง Admin User
        $admin = User::create([
            'employee_id' => 'AD001',
            'name' => 'Admin',
            'department' => 'IT',
            'position' => 'Administrator',
            'phone_number' => '0812345678',
            'email' => 'admin@admin.com',
            'profile' => 'user.avif',
            'password' => bcrypt('password'),
            'employment_status' => 'active',
        ]);

        // สร้าง Writer User
        $writer = User::create([
            'employee_id' => 'WR001',
            'name' => 'Writer',
            'department' => 'Content',
            'position' => 'Content Creator',
            'phone_number' => '0898765432',
            'email' => 'writer@writer.com',
            'password' => bcrypt('password'),
            'employment_status' => 'active',
        ]);

        // สร้าง Roles
        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'writer']);

        // สร้าง Permissions จากข้อมูลที่คุณให้มา
        $permissionsData = [
            ['name' => 'Report read', 'guard_name' => 'web'],
            ['name' => 'Report update', 'guard_name' => 'web'],
            ['name' => 'Report create', 'guard_name' => 'web'],
            ['name' => 'Report delete', 'guard_name' => 'web'],
            ['name' => 'Role read', 'guard_name' => 'web'],
            ['name' => 'Role update', 'guard_name' => 'web'],
            ['name' => 'Role create', 'guard_name' => 'web'],
            ['name' => 'Role delete', 'guard_name' => 'web'],
            ['name' => 'User read', 'guard_name' => 'web'],
            ['name' => 'User update', 'guard_name' => 'web'],
            ['name' => 'User create', 'guard_name' => 'web'],
            ['name' => 'User delete', 'guard_name' => 'web'],
            // ['name' => 'Mail access', 'guard_name' => 'web'],
            // ['name' => 'Mail edit', 'guard_name' => 'web'],
            // ['name' => 'Permission read', 'guard_name' => 'web'],
            // ['name' => 'Permission create', 'guard_name' => 'web'],
            // ['name' => 'Permission update', 'guard_name' => 'web'],
            // ['name' => 'Permission delete', 'guard_name' => 'web'],
            ['name' => 'Inregister read', 'guard_name' => 'web'],
            ['name' => 'Inregister create', 'guard_name' => 'web'],
            ['name' => 'Inregister update', 'guard_name' => 'web'],
            ['name' => 'Inregister delete', 'guard_name' => 'web'],

            ['name' => 'RegisterNew read', 'guard_name' => 'web'],
            ['name' => 'RegisterNew create', 'guard_name' => 'web'],
            ['name' => 'RegisterNew update', 'guard_name' => 'web'],
            ['name' => 'RegisterNew delete', 'guard_name' => 'web'],

            ['name' => 'RegisterContinue read', 'guard_name' => 'web'],
            ['name' => 'RegisterContinue create', 'guard_name' => 'web'],
            ['name' => 'RegisterContinue update', 'guard_name' => 'web'],
            ['name' => 'RegisterContinue delete', 'guard_name' => 'web'],

            ['name' => 'RegisterManufacture read', 'guard_name' => 'web'],
            ['name' => 'RegisterManufacture create', 'guard_name' => 'web'],
            ['name' => 'RegisterManufacture update', 'guard_name' => 'web'],
            ['name' => 'RegisterManufacture delete', 'guard_name' => 'web'],

            ['name' => 'Company read', 'guard_name' => 'web'],
            ['name' => 'Company create', 'guard_name' => 'web'],
            ['name' => 'Company update', 'guard_name' => 'web'],
            ['name' => 'Company delete', 'guard_name' => 'web'],
        ];

        foreach ($permissionsData as $permissionItem) {
            Permission::create(['name' => $permissionItem['name'], 'guard_name' => $permissionItem['guard_name']]);
        }

        // กำหนด Role ให้ User
        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);

        // ให้ Admin Role มีทุก Permissions
        $admin_role->givePermissionTo(Permission::all());
    }
}
