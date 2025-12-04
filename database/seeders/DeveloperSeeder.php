<?php
// database/seeders/DeveloperSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DeveloperSeeder extends Seeder
{
    public function run()
    {
        // Get the Super Admin role
        $superAdminRole = Role::where('name', 'Super Admin')->first();

        if (!$superAdminRole) {
            $this->command->error('Super Admin role not found! Please run RolePermissionSeeder first.');
            return;
        }

        // Developer credentials
        $developers = [
             [
                'email' => 'superadmin@wb.gov.in',
                'name' => 'Super Admin',
                'sso_id' => 1,
                'password' => 'Dev@12345',
                'dise_code' => '98765432101',
                'department' => 'IT Department',
                'designation' => 'System Administrator',
                'status' => true,
            ],
            [
                'email' => 'developer1.sed.wb@gmail.com',
                'name' => 'Developer One',
                'sso_id' => 1001,
                'password' => 'Dev@12345',
                'dise_code' => '12345678901',
                'department' => 'Software Development',
                'designation' => 'Senior Developer',
                'status' => true,
            ],
            [
                'email' => 'developer2.sed.wb@gmail.com',
                'name' => 'Developer Two',
                'sso_id' => 1002,
                'password' => 'Dev@12345',
                'dise_code' => '12345678902',
                'department' => 'Software Development',
                'designation' => 'Backend Developer',
                'status' => true,
            ],
            [
                'email' => 'developer3.sed.wb@gmail.com',
                'name' => 'Developer Three',
                'sso_id' => 1003,
                'password' => 'Dev@12345',
                'dise_code' => '12345678903',
                'department' => 'Software Development',
                'designation' => 'Frontend Developer',
                'status' => true,
            ],
            [
                'email' => 'developer4.sed.wb@gmail.com',
                'name' => 'Developer Four',
                'sso_id' => 1004,
                'password' => 'Dev@12345',
                'dise_code' => '12345678904',
                'department' => 'Software Development',
                'designation' => 'Full Stack Developer',
                'status' => true,
            ],
        ];

        $this->command->info('Creating developer accounts...');
        $this->command->info('');

        foreach ($developers as $developer) {
            // Check if user already exists
            $existingUser = User::where('email', $developer['email'])->first();

            if ($existingUser) {
                // Update existing user
                $existingUser->update([
                    'name' => $developer['name'],
                    'sso_id' => $developer['sso_id'],
                    'password' => Hash::make($developer['password']),
                    'department' => $developer['department'],
                    'designation' => $developer['designation'],
                    'status' => $developer['status'],
                ]);

                // Sync role
                $existingUser->syncRoles([$superAdminRole]);

                $this->command->info("✅ Updated: {$developer['email']}");
            } else {
                // Create new user
                $user = User::create([
                    'name' => $developer['name'],
                    'email' => $developer['email'],
                    'sso_id' => $developer['sso_id'],
                    'password' => bcrypt($developer['password']),
                    'department' => $developer['department'],
                    'designation' => $developer['designation'],
                    'status' => $developer['status'],
                ]);

                // Assign Super Admin role
                $user->assignRole($superAdminRole);

                $this->command->info("✅ Created: {$developer['email']}");
            }
        }

        $this->command->info('');
        $this->command->info('🎉 Developer accounts created successfully!');
        $this->command->info('');
        $this->command->info('📋 Developer Credentials:');
        $this->command->info('================================');

        foreach ($developers as $developer) {
            $this->command->info("👤 Name: {$developer['name']}");
            $this->command->info("📧 Email: {$developer['email']}");
            $this->command->info("🔑 Password: {$developer['password']}");
            $this->command->info("🏢 Department: {$developer['department']}");
            $this->command->info("💼 Designation: {$developer['designation']}");
            $this->command->info("👑 Role: Super Admin");
            $this->command->info("---");
        }

        $this->command->info('');
        $this->command->info('💡 Note: All developers have Super Admin privileges.');
        $this->command->info('🚨 Important: Change passwords in production environment!');
    }
}
