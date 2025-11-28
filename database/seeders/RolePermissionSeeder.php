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
        User::truncate();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for all menu items - maintaining two-word format with single space
        $permissions = [
            // Dashboard
            'view dashboard',

            // Access Control
            'view users', 'create users', 'edit users', 'delete users', 'impersonate users',
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view modules', 'create modules', 'edit modules', 'delete modules',
            'view permissions', 'create permissions', 'edit permissions', 'delete permissions',

            // Uniform SCMS Module
            'view uniform', 'view scms', 'view delivery',

            // Student Delete / Deactivate
            'view delete', 'manage delete', 'view deactivate', 'manage deactivate',

            // Student Entry / Update
            'view entry', 'create entry', 'edit entry', 'delete entry',
            'view profile', 'edit profile', 'download profile',
            'update basic', 'update aadhar', 'manage mapping',
            'update identity', 'manage additional', 'update section',
            'bulk upload', 'update polling',

            // School Information
            'view school', 'create school', 'edit school', 'delete school', 'list schools',
            'view survey', 'manage survey', 'view contacts', 'update contacts',

            // Student Information
            'view students', 'export students', 'view enrollment', 'generate enrollment', 'export enrollment',

            // Employee Management
            'view employees', 'create employees', 'edit employees', 'delete employees', 'export employees',

            // School Management
            'view management', 'manage management', 'view udise',

            // Reports
            'view reports', 'generate reports', 'export reports',
            'view beneficiary', 'export beneficiary',

            // System
            'manage system', 'view audit', 'export data',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $roles = [
            'Super Admin' => $permissions, // All permissions

            'State Admin' => [
                'view dashboard',

                // Access Control
                'view roles', 'view modules', 'view permissions',

                // Uniform SCMS
                'view uniform', 'view scms', 'view delivery',

                // Student Delete/Deactivate
                'view delete', 'manage delete', 'view deactivate', 'manage deactivate',

                // Student Entry/Update
                'view entry', 'create entry', 'edit entry',
                'view profile', 'edit profile', 'download profile',
                'update basic', 'update aadhar', 'manage mapping',
                'update identity', 'manage additional', 'update section',
                'bulk upload', 'update polling',

                // School Information
                'view school', 'create school', 'edit school', 'list schools',
                'view survey', 'manage survey', 'view contacts', 'update contacts',

                // Student Information
                'view students', 'export students',
                'view enrollment', 'generate enrollment', 'export enrollment',

                // Employee Management
                'view employees', 'create employees', 'edit employees', 'export employees',

                // School Management
                'view management', 'manage management', 'view udise',

                // Reports
                'view reports', 'generate reports', 'export reports',
                'view beneficiary', 'export beneficiary',

                // System
                'export data',
            ],

            'District Admin' => [
                'view dashboard',

                // Uniform SCMS
                'view uniform', 'view scms', 'view delivery',

                // Student Delete/Deactivate
                'view delete', 'manage delete', 'view deactivate', 'manage deactivate',

                // Student Entry/Update
                'view entry', 'create entry', 'edit entry',
                'view profile', 'edit profile', 'download profile',
                'update basic', 'update aadhar', 'manage mapping',
                'update identity', 'manage additional', 'update section',
                'bulk upload', 'update polling',

                // School Information
                'view school', 'create school', 'edit school', 'list schools',
                'view survey', 'manage survey', 'view contacts', 'update contacts',

                // Student Information
                'view students', 'export students',
                'view enrollment', 'generate enrollment', 'export enrollment',

                // Employee Management
                'view employees', 'create employees', 'edit employees',

                // School Management
                'view management', 'view udise',

                // Reports
                'view reports', 'generate reports', 'export reports',
                'view beneficiary', 'export beneficiary',
            ],

            'Block Admin' => [
                'view dashboard',

                // Uniform SCMS
                'view uniform', 'view scms', 'view delivery',

                // Student Entry/Update
                'view entry', 'create entry', 'edit entry',
                'view profile', 'edit profile', 'download profile',
                'update basic', 'update aadhar', 'manage mapping',
                'update identity', 'manage additional', 'update section',

                // School Information
                'view school', 'list schools',
                'view survey', 'view contacts', 'update contacts',

                // Student Information
                'view students', 'export students',
                'view enrollment', 'generate enrollment',

                // Employee Management
                'view employees',

                // School Management
                'view management', 'view udise',

                // Reports
                'view reports', 'generate reports',
                'view beneficiary',
            ],

            'School Admin' => [
                'view dashboard',

                // Uniform SCMS
                'view uniform', 'view scms', 'view delivery',

                // Student Entry/Update
                'view entry', 'create entry', 'edit entry',
                'view profile', 'edit profile', 'download profile',
                'update basic', 'update aadhar', 'manage mapping',
                'update identity', 'manage additional', 'update section',
                'bulk upload',

                // School Information
                'view school', 'list schools',
                'view survey', 'view contacts', 'update contacts',

                // Student Information
                'view students', 'export students',
                'view enrollment', 'generate enrollment',

                // Employee Management
                'view employees',

                // School Management
                'view management', 'view udise',

                // Reports
                'view reports', 'generate reports',
                'view beneficiary',
            ],

            'Teacher' => [
                'view dashboard',

                // Student Entry/Update
                'view entry', 'create entry',
                'view profile', 'download profile',
                'update basic', 'update section',

                // Student Information
                'view students',
                'view enrollment',

                // Reports
                'view reports',
                'view beneficiary',
            ],

            'Data Entry Operator' => [
                'view dashboard',

                // Student Entry/Update
                'view entry', 'create entry',
                'view profile',
                'update basic',
                'bulk upload',

                // Student Information
                'view students',
                'view enrollment',
            ],

            'Viewer' => [
                'view dashboard',
                'view students',
                'view enrollment',
                'view reports',
                'view school',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($rolePermissions);
        }

        // Create default users for each role
        $defaultUsers = [
            'Super Admin' => [
                'email' => 'superadmin@wb.gov.in',
                'name' => 'Super Admin',
                'sso_id' => 1,
                'password' => 'superadmin123',
                'department' => 'IT Department',
                'designation' => 'System Administrator',
            ],
            'State Admin' => [
                'email' => 'stateadmin@education.gov',
                'name' => 'State Admin',
                'sso_id' => 2,
                'password' => 'password',
                'department' => 'Education Department',
                'designation' => 'State Administrator',
            ],
            'District Admin' => [
                'email' => 'districtadmin@education.gov',
                'name' => 'District Admin',
                'sso_id' => 3,
                'password' => 'password',
                'department' => 'Education Department',
                'designation' => 'District Administrator',
            ],
            'Block Admin' => [
                'email' => 'blockadmin@education.gov',
                'name' => 'Block Admin',
                'sso_id' => 4,
                'password' => 'password',
                'department' => 'Education Department',
                'designation' => 'Block Education Officer',
            ],
            'School Admin' => [
                'email' => 'schooladmin@education.gov',
                'name' => 'School Admin',
                'sso_id' => 5,
                'password' => 'password',
                'department' => 'School Administration',
                'designation' => 'Principal',
            ],
            'Teacher' => [
                'email' => 'teacher@school.edu',
                'name' => 'Teacher',
                'sso_id' => 6,
                'password' => 'password',
                'department' => 'Teaching Staff',
                'designation' => 'Teacher',
            ],
            'Data Entry Operator' => [
                'email' => 'dataentry@school.edu',
                'name' => 'Data Entry Operator',
                'sso_id' => 7,
                'password' => 'password',
                'department' => 'Administration',
                'designation' => 'Data Entry Operator',
            ],
            'Viewer' => [
                'email' => 'viewer@education.gov',
                'name' => 'Viewer',
                'sso_id' => 8,
                'password' => 'password',
                'department' => 'Monitoring Department',
                'designation' => 'Monitoring Officer',
            ],
        ];

        foreach ($defaultUsers as $roleName => $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'sso_id' => $userData['sso_id'],
                    'password' => bcrypt($userData['password']),
                    'department' => $userData['department'],
                    'designation' => $userData['designation'],
                    'status' => true,
                ]
            );

            $user->assignRole($roleName);
        }

        $this->command->info('Role permissions seeded successfully!');
        $this->command->info('');
        $this->command->info('Default users created:');
        foreach ($defaultUsers as $roleName => $userData) {
            $this->command->info("Role: {$roleName}");
            $this->command->info("Email: {$userData['email']}");
            $this->command->info("Password: {$userData['password']}");
            $this->command->info('---');
        }
    }
}
