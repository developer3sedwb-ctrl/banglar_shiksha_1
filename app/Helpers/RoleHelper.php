<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('current_user_role')) {
    function current_user_role(): ?string
    {
        $user = Auth::user();
        return $user?->roles()->pluck('name')->first();
    }
}

if (!function_exists('user_roles_map')) {
    function user_roles_map(): array
    {
        $role = current_user_role();

        return [
            'role_name'           => $role,
            'is_super_admin'      => $role === 'Super Admin',
            'is_hoi_primary'      => $role === 'HOI Primary',
            'is_school_admin'     => $role === 'School Admin',
            'is_circle_officer'   => $role === 'Circle',
            'is_district_officer' => $role === 'District Officer',
            'is_school_user'      => in_array($role, ['School Admin', 'HOI Primary']),
        ];
    }
}

if (!function_exists('is_super_admin')) {
    function is_super_admin(): bool
    {
        return user_roles_map()['is_super_admin'];
    }
}

if (!function_exists('is_school_user')) {
    function is_school_user(): bool
    {
        return user_roles_map()['is_school_user'];
    }
}

if (!function_exists('is_circle_officer')) {
    function is_circle_officer(): bool
    {
        return user_roles_map()['is_circle_officer'];
    }
}
