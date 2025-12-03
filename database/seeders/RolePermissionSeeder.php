<?php
// database/seeders/RolePermissionSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // truncate existing roles, permissions, and User
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        Role::truncate();
        Permission::truncate();
        // User::truncate();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for all menu items - maintaining two-word format with single space
        // Create permissions with group names
        $permissions = [
            // Dashboard
            ['name' => 'view dashboard', 'group_name' => 'Dashboard'],

            // Access Control
            ['name' => 'view users', 'group_name' => 'Access Control'],
            ['name' => 'create users', 'group_name' => 'Access Control'],
            ['name' => 'edit users', 'group_name' => 'Access Control'],
            ['name' => 'delete users', 'group_name' => 'Access Control'],
            ['name' => 'impersonate users', 'group_name' => 'Access Control'],
            ['name' => 'view roles', 'group_name' => 'Access Control'],
            ['name' => 'create roles', 'group_name' => 'Access Control'],
            ['name' => 'edit roles', 'group_name' => 'Access Control'],
            ['name' => 'delete roles', 'group_name' => 'Access Control'],
            ['name' => 'view modules', 'group_name' => 'Access Control'],
            ['name' => 'create modules', 'group_name' => 'Access Control'],
            ['name' => 'edit modules', 'group_name' => 'Access Control'],
            ['name' => 'delete modules', 'group_name' => 'Access Control'],
            ['name' => 'view permissions', 'group_name' => 'Access Control'],
            ['name' => 'create permissions', 'group_name' => 'Access Control'],
            ['name' => 'edit permissions', 'group_name' => 'Access Control'],
            ['name' => 'delete permissions', 'group_name' => 'Access Control'],

            // Uniform SCMS Module
            ['name' => 'view uniform', 'group_name' => 'Uniform SCMS'],
            ['name' => 'view scms', 'group_name' => 'Uniform SCMS'],
            ['name' => 'view delivery', 'group_name' => 'Uniform SCMS'],

            // Student Delete / Deactivate
            ['name' => 'view delete', 'group_name' => 'Student Management'],
            ['name' => 'manage delete', 'group_name' => 'Student Management'],
            ['name' => 'view deactivate', 'group_name' => 'Student Management'],
            ['name' => 'manage deactivate', 'group_name' => 'Student Management'],

            // Student Entry / Update
            ['name' => 'view entry', 'group_name' => 'Student Entry'],
            ['name' => 'create entry', 'group_name' => 'Student Entry'],
            ['name' => 'edit entry', 'group_name' => 'Student Entry'],
            ['name' => 'delete entry', 'group_name' => 'Student Entry'],
            ['name' => 'view profile', 'group_name' => 'Student Entry'],
            ['name' => 'edit profile', 'group_name' => 'Student Entry'],
            ['name' => 'download profile', 'group_name' => 'Student Entry'],
            ['name' => 'update basic', 'group_name' => 'Student Entry'],
            ['name' => 'update aadhar', 'group_name' => 'Student Entry'],
            ['name' => 'manage mapping', 'group_name' => 'Student Entry'],
            ['name' => 'update identity', 'group_name' => 'Student Entry'],
            ['name' => 'manage additional', 'group_name' => 'Student Entry'],
            ['name' => 'update section', 'group_name' => 'Student Entry'],
            ['name' => 'bulk upload', 'group_name' => 'Student Entry'],
            ['name' => 'update polling', 'group_name' => 'Student Entry'],

            // School Information
            ['name' => 'view school', 'group_name' => 'School Information'],
            ['name' => 'create school', 'group_name' => 'School Information'],
            ['name' => 'edit school', 'group_name' => 'School Information'],
            ['name' => 'delete school', 'group_name' => 'School Information'],
            ['name' => 'list schools', 'group_name' => 'School Information'],
            ['name' => 'view survey', 'group_name' => 'School Information'],
            ['name' => 'manage survey', 'group_name' => 'School Information'],
            ['name' => 'view contacts', 'group_name' => 'School Information'],
            ['name' => 'update contacts', 'group_name' => 'School Information'],

            // Student Information
            ['name' => 'view students', 'group_name' => 'Student Information'],
            ['name' => 'export students', 'group_name' => 'Student Information'],
            ['name' => 'view enrollment', 'group_name' => 'Student Information'],
            ['name' => 'generate enrollment', 'group_name' => 'Student Information'],
            ['name' => 'export enrollment', 'group_name' => 'Student Information'],

            // Employee Management
            ['name' => 'view employees', 'group_name' => 'Employee Management'],
            ['name' => 'create employees', 'group_name' => 'Employee Management'],
            ['name' => 'edit employees', 'group_name' => 'Employee Management'],
            ['name' => 'delete employees', 'group_name' => 'Employee Management'],
            ['name' => 'export employees', 'group_name' => 'Employee Management'],

            // School Management
            ['name' => 'view management', 'group_name' => 'School Management'],
            ['name' => 'manage management', 'group_name' => 'School Management'],
            ['name' => 'view udise', 'group_name' => 'School Management'],

            // Reports
            ['name' => 'view reports', 'group_name' => 'Reports'],
            ['name' => 'generate reports', 'group_name' => 'Reports'],
            ['name' => 'export reports', 'group_name' => 'Reports'],
            ['name' => 'view beneficiary', 'group_name' => 'Reports'],
            ['name' => 'export beneficiary', 'group_name' => 'Reports'],

            // System
            ['name' => 'manage system', 'group_name' => 'System'],
            ['name' => 'view audit', 'group_name' => 'System'],
            ['name' => 'export data', 'group_name' => 'System'],
        ];

        // Create permissions with group_name
        foreach ($permissions as $permissionData) {
            Permission::create([
                'name' => $permissionData['name'],
                'group_name' => $permissionData['group_name'],
                'guard_name' => 'web'
            ]);
        }

        // Create roles and assign permissions
        $roles = [
            // All permissions
            'Super Admin' => [
                'permissions' => array_column($permissions, 'name'),
                'stakeholder' => 'system',
            ],
            'State Admin' => [
                'permissions' => [
                    'view dashboard',

                    // Access Control
                    'view roles',
                    'view modules',
                    'view permissions',

                    // Uniform SCMS
                    'view uniform',
                    'view scms',
                    'view delivery',

                    // Student Delete/Deactivate
                    'view delete',
                    'manage delete',
                    'view deactivate',
                    'manage deactivate',

                    // Student Entry/Update
                    'view entry',
                    'create entry',
                    'edit entry',
                    'view profile',
                    'edit profile',
                    'download profile',
                    'update basic',
                    'update aadhar',
                    'manage mapping',
                    'update identity',
                    'manage additional',
                    'update section',
                    'bulk upload',
                    'update polling',

                    // School Information
                    'view school',
                    'create school',
                    'edit school',
                    'list schools',
                    'view survey',
                    'manage survey',
                    'view contacts',
                    'update contacts',

                    // Student Information
                    'view students',
                    'export students',
                    'view enrollment',
                    'generate enrollment',
                    'export enrollment',

                    // Employee Management
                    'view employees',
                    'create employees',
                    'edit employees',
                    'export employees',

                    // School Management
                    'view management',
                    'manage management',
                    'view udise',

                    // Reports
                    'view reports',
                    'generate reports',
                    'export reports',
                    'view beneficiary',
                    'export beneficiary',

                    // System
                    'export data',
                ],
                'stakeholder' => 'state',
            ],

            'District Admin' => [
                'permissions' => [
                    'view dashboard',

                    // Uniform SCMS
                    'view uniform',
                    'view scms',
                    'view delivery',

                    // Student Delete/Deactivate
                    'view delete',
                    'manage delete',
                    'view deactivate',
                    'manage deactivate',

                    // Student Entry/Update
                    'view entry',
                    'create entry',
                    'edit entry',
                    'view profile',
                    'edit profile',
                    'download profile',
                    'update basic',
                    'update aadhar',
                    'manage mapping',
                    'update identity',
                    'manage additional',
                    'update section',
                    'bulk upload',
                    'update polling',

                    // School Information
                    'view school',
                    'create school',
                    'edit school',
                    'list schools',
                    'view survey',
                    'manage survey',
                    'view contacts',
                    'update contacts',

                    // Student Information
                    'view students',
                    'export students',
                    'view enrollment',
                    'generate enrollment',
                    'export enrollment',

                    // Employee Management
                    'view employees',
                    'create employees',
                    'edit employees',

                    // School Management
                    'view management',
                    'view udise',

                    // Reports
                    'view reports',
                    'generate reports',
                    'export reports',
                    'view beneficiary',
                    'export beneficiary',
                ],
                'stakeholder' => 'district',
            ],

            'Block Admin' => [
                'permissions' => [
                    'view dashboard',

                    // Uniform SCMS
                    'view uniform',
                    'view scms',
                    'view delivery',

                    // Student Entry/Update
                    'view entry',
                    'create entry',
                    'edit entry',
                    'view profile',
                    'edit profile',
                    'download profile',
                    'update basic',
                    'update aadhar',
                    'manage mapping',
                    'update identity',
                    'manage additional',
                    'update section',

                    // School Information
                    'view school',
                    'list schools',
                    'view survey',
                    'view contacts',
                    'update contacts',

                    // Student Information
                    'view students',
                    'export students',
                    'view enrollment',
                    'generate enrollment',

                    // Employee Management
                    'view employees',

                    // School Management
                    'view management',
                    'view udise',

                    // Reports
                    'view reports',
                    'generate reports',
                    'view beneficiary',
                ],
                'stakeholder' => 'block',
            ],

            'School Admin' => [
                'permissions' => [
                    'view dashboard',

                    // Uniform SCMS
                    'view uniform',
                    'view scms',
                    'view delivery',

                    // Student Entry/Update
                    'view entry',
                    'create entry',
                    'edit entry',
                    'view profile',
                    'edit profile',
                    'download profile',
                    'update basic',
                    'update aadhar',
                    'manage mapping',
                    'update identity',
                    'manage additional',
                    'update section',
                    'bulk upload',

                    // School Information
                    'view school',
                    'list schools',
                    'view survey',
                    'view contacts',
                    'update contacts',

                    // Student Information
                    'view students',
                    'export students',
                    'view enrollment',
                    'generate enrollment',

                    // Employee Management
                    'view employees',

                    // School Management
                    'view management',
                    'view udise',

                    // Reports
                    'view reports',
                    'generate reports',
                    'view beneficiary',
                ],
                'stakeholder' => 'school',
            ],


        ];

        foreach ($roles as $roleName => $roleData) {
            $role = Role::create([
                'name' => $roleName,
                'stakeholder' => $roleData['stakeholder'],
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($roleData['permissions']);
        }


        // Create default users for each role
        // $defaultUsers = [
        //     'Super Admin' => [
        //         'email' => 'superadmin@wb.gov.in',
        //         'name' => 'Super Admin',
        //         'sso_id' => 1,
        //         'password' => 'superadmin123',
        //         'department' => 'IT Department',
        //         'designation' => 'System Administrator',
        //     ],
        //     'State Admin' => [
        //         'email' => 'stateadmin@education.gov',
        //         'name' => 'State Admin',
        //         'sso_id' => 2,
        //         'password' => 'password',
        //         'department' => 'Education Department',
        //         'designation' => 'State Administrator',
        //     ],
        //     'District Admin' => [
        //         'email' => 'districtadmin@education.gov',
        //         'name' => 'District Admin',
        //         'sso_id' => 3,
        //         'password' => 'password',
        //         'department' => 'Education Department',
        //         'designation' => 'District Administrator',
        //     ],
        //     'Block Admin' => [
        //         'email' => 'blockadmin@education.gov',
        //         'name' => 'Block Admin',
        //         'sso_id' => 4,
        //         'password' => 'password',
        //         'department' => 'Education Department',
        //         'designation' => 'Block Education Officer',
        //     ],
        //     'School Admin' => [
        //         'email' => 'schooladmin@education.gov',
        //         'name' => 'School Admin',
        //         'sso_id' => 5,
        //         'password' => 'password',
        //         'department' => 'School Administration',
        //         'designation' => 'Principal',
        //     ],
        //     'Teacher' => [
        //         'email' => 'teacher@school.edu',
        //         'name' => 'Teacher',
        //         'sso_id' => 6,
        //         'password' => 'password',
        //         'department' => 'Teaching Staff',
        //         'designation' => 'Teacher',
        //     ],
        //     'Data Entry Operator' => [
        //         'email' => 'dataentry@school.edu',
        //         'name' => 'Data Entry Operator',
        //         'sso_id' => 7,
        //         'password' => 'password',
        //         'department' => 'Administration',
        //         'designation' => 'Data Entry Operator',
        //     ],
        //     'Viewer' => [
        //         'email' => 'viewer@education.gov',
        //         'name' => 'Viewer',
        //         'sso_id' => 8,
        //         'password' => 'password',
        //         'department' => 'Monitoring Department',
        //         'designation' => 'Monitoring Officer',
        //     ],
        // ];

        // foreach ($defaultUsers as $roleName => $userData) {
        //     $user = User::firstOrCreate(
        //         ['email' => $userData['email']],
        //         [
        //             'name' => $userData['name'],
        //             'sso_id' => $userData['sso_id'],
        //             'password' => bcrypt($userData['password']),
        //             'department' => $userData['department'],
        //             'designation' => $userData['designation'],
        //             'status' => true,
        //         ]
        //     );

        //     $user->assignRole($roleName);
        // }

        // $this->command->info('Role permissions seeded successfully!');
        // $this->command->info('');
        // $this->command->info('Default users created:');
        // foreach ($defaultUsers as $roleName => $userData) {
        //     $this->command->info("Role: {$roleName}");
        //     $this->command->info("Email: {$userData['email']}");
        //     $this->command->info("Password: {$userData['password']}");
        //     $this->command->info('---');
        // }
    }
}
