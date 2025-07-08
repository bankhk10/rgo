<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Clear cache (optional)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // สร้าง Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'employee_id' => 'AD001',
                'name' => 'Admin',
                'department' => 'IT',
                'position' => 'Administrator',
                'phone_number' => '0812345678',
                'profile' => 'user.avif',
                'password' => bcrypt('password'),
                'employment_status' => 'active',
            ]
        );

        // สร้าง Writer
        $writer = User::firstOrCreate(
            ['email' => 'writer@writer.com'],
            [
                'employee_id' => 'WR001',
                'name' => 'Writer',
                'department' => 'Content',
                'position' => 'Content Creator',
                'phone_number' => '0898765432',
                'password' => bcrypt('password'),
                'employment_status' => 'active',
            ]
        );

        // สร้าง Role หลัก
        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $writer_role = Role::firstOrCreate(['name' => 'writer']);

        // Permissions ทั้งหมด
        $permissions = [
            // Report
            'Report read',
            'Report update',
            'Report create',
            'Report delete',
            // Role
            'Role read',
            'Role update',
            'Role create',
            'Role delete',
            // User
            'User read',
            'User update',
            'User create',
            'User delete',
            // Inregister
            'Inregister read',
            'Inregister create',
            'Inregister update',
            'Inregister delete',
            // Register New
            'RegisterNew read',
            'RegisterNew create',
            'RegisterNew update',
            'RegisterNew delete',
            // Register Continue
            'RegisterContinue read',
            'RegisterContinue create',
            'RegisterContinue update',
            'RegisterContinue delete',
            // Register Manufacture
            'RegisterManufacture read',
            'RegisterManufacture create',
            'RegisterManufacture update',
            'RegisterManufacture delete',
            // Company
            'Company read',
            'Company create',
            'Company update',
            'Company delete',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        $admin_role->syncPermissions(Permission::all());
        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);

        // แผนกและตำแหน่ง
        $departments = ['ทะเบียน', 'จัดซื้อต่างประเทศ', 'วิจัยและพัฒนา', 'วิชาการ', 'ฝ่ายขาย', 'เทคโนโลยีสารสนเทศ'];
        $departmentSlugs = [
            'ทะเบียน' => 'register',
            'จัดซื้อต่างประเทศ' => 'foreign_purchase',
            'วิจัยและพัฒนา' => 'research',
            'วิชาการ' => 'academic',
            'ฝ่ายขาย' => 'sales',
            'เทคโนโลยีสารสนเทศ' => 'it',
        ];
        $positions = [
            'manager' => 'ผู้จัดการแผนก',
            'head' => 'หัวหน้า',
            'staff' => 'พนักงาน',
        ];

        // Permission ตามแผนกและตำแหน่ง
        $permissionMap = [
            'ทะเบียน' => [
                'manager' => ['RegisterNew read', 'RegisterNew create', 'RegisterNew update', 'RegisterNew delete', 'RegisterContinue read', 'RegisterContinue create', 'RegisterContinue update', 'RegisterContinue delete', 'RegisterManufacture read', 'RegisterManufacture create', 'RegisterManufacture update', 'RegisterManufacture delete'],
                'head' => ['RegisterNew read', 'RegisterNew update', 'RegisterContinue read', 'RegisterContinue update'],
                'staff' => ['RegisterNew read', 'RegisterNew create'],
            ],
            'จัดซื้อต่างประเทศ' => [
                'manager' => ['Inregister read', 'Inregister create', 'Inregister update', 'Inregister delete'],
                'head' => ['Inregister read', 'Inregister update'],
                'staff' => ['Inregister read', 'Inregister create'],
            ],
            'วิจัยและพัฒนา' => [
                'manager' => ['Report read', 'Report create', 'Report update', 'Report delete'],
                'head' => ['Report read', 'Report update'],
                'staff' => ['Report read', 'Report create'],
            ],
            'วิชาการ' => [
                'manager' => ['Company read', 'Company create', 'Company update', 'Company delete'],
                'head' => ['Company read', 'Company update'],
                'staff' => ['Company read'],
            ],
            'ฝ่ายขาย' => [
                'manager' => ['User read', 'User create', 'User update', 'User delete'],
                'head' => ['User read', 'User update'],
                'staff' => ['User read'],
            ],
            'เทคโนโลยีสารสนเทศ' => [
                'manager' => ['Role read', 'Role create', 'Role update', 'Role delete'],
                'head' => ['Role read', 'Role update'],
                'staff' => ['Role read'],
            ],
        ];

        foreach ($departments as $department) {
            $slug = $departmentSlugs[$department] ?? Str::slug($department, '_');

            foreach ($positions as $key => $positionName) {
                $roleName = "{$key}_{$slug}";

                $role = Role::firstOrCreate(['name' => $roleName]);

                $email = "{$key}_{$slug}@company.com";
                $employeeId = strtoupper(substr($key, 0, 2)) . strtoupper(substr($slug, 0, 2)) . rand(100, 999);

                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'employee_id' => $employeeId,
                        'name' => "{$positionName}แผนก{$department}",
                        'department' => $department,
                        'position' => $positionName,
                        'phone_number' => '0800000000',
                        'password' => bcrypt('password'),
                        'employment_status' => 'active',
                    ]
                );

                $user->assignRole($role);

                if (isset($permissionMap[$department][$key])) {
                    $role->syncPermissions($permissionMap[$department][$key]);
                }
            }
        }
    }
}
