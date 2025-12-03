<?php
// app/Http/Controllers/Admin/RoleController.php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view roles', ['only' => ['index', 'show']]);
        $this->middleware('permission:create roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $stakeholder = $request->get('stakeholder');
        $users_count = $request->get('users_count');
        $permissions_count = $request->get('permissions_count');

        $roles = Role::withCount(['users', 'permissions'])
            ->with('permissions') // Eager load permissions for display
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($stakeholder, function ($query) use ($stakeholder) {
                return $query->where('stakeholder', $stakeholder);
            })
            ->when($users_count, function ($query) use ($users_count) {
                if ($users_count === '0') {
                    return $query->having('users_count', '=', 0);
                } elseif ($users_count === '1-10') {
                    return $query->having('users_count', '>', 0)->having('users_count', '<=', 10);
                } elseif ($users_count === '10+') {
                    return $query->having('users_count', '>', 10);
                }
            })
            ->when($permissions_count, function ($query) use ($permissions_count) {
                if ($permissions_count === '0') {
                    return $query->having('permissions_count', '=', 0);
                } elseif ($permissions_count === '1-10') {
                    return $query->having('permissions_count', '>', 0)->having('permissions_count', '<=', 10);
                } elseif ($permissions_count === '10+') {
                    return $query->having('permissions_count', '>', 10);
                }
            })
            ->orderBy('stakeholder')
            ->orderBy('name')
            ->paginate(20); // Reduced from 50 for better UX

        // Calculate stats
        $totalRoles = Role::count();
        $rolesWithUsers = Role::has('users')->count();
        $rolesWithPermissions = Role::has('permissions')->count();
        $protectedRoles = Role::whereIn('name', ['Super Admin', 'State Admin'])->count();

        $stakeholderTypes = Role::whereNotNull('stakeholder')
            ->distinct('stakeholder')
            ->pluck('stakeholder')
            ->filter()
            ->values()
            ->all();

        return view('admin.roles.index', compact(
            'roles',
            'search',
            'stakeholder',
            'stakeholderTypes',
            'totalRoles',
            'rolesWithUsers',
            'rolesWithPermissions',
            'protectedRoles',
            'users_count',
            'permissions_count'
        ));
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('group_name')
            ->orderBy('name')
            ->get()
            ->groupBy('group_name');

        $stakeholderTypes = Role::all()->pluck('stakeholder')->unique()->filter()->values()->all();


        return view('admin.roles.create', compact('permissions', 'stakeholderTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Determine stakeholder value
        $stakeholder = $request->stakeholder;
        if ($stakeholder === 'custom') {
            $stakeholder = $request->custom_stakeholder;
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'stakeholder' => 'nullable|string|max:100',
            'custom_stakeholder' => 'nullable|string|max:100',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        // Additional validation for custom stakeholder
        if ($request->stakeholder === 'custom') {
            $request->validate([
                'custom_stakeholder' => 'required|string|max:100',
            ]);
        }

        try {
            // Start transaction
            DB::beginTransaction();
            $role = Role::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'stakeholder' => $stakeholder,
                'guard_name' => 'web',
            ]);

            // Only sync permissions if they exist and are valid
            if ($request->has('permissions') && is_array($request->permissions)) {
                // Filter out any non-numeric values and validate permissions exist
                $permissionIds = array_filter($request->permissions, 'is_numeric');

                // Get only existing permission IDs from database
                $existingPermissionIds = Permission::whereIn('id', $permissionIds)
                    ->pluck('id')
                    ->toArray();

                if (!empty($existingPermissionIds)) {
                    $role->syncPermissions($existingPermissionIds);
                }
            }

            // Commit transaction
            DB::commit();
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role "' . $role->name . '" created successfully.');
        } catch (\Exception $e) {
            // Rollback transaction on any other error
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while creating the role: ' . $e->getMessage()]);
        }
    }

    public function show(Role $role): View
    {
        $role->load(['permissions', 'users']);

        // Group permissions by group_name
        $permissionsByGroup = $role->permissions->groupBy('group_name')->map(function ($group) {
            return $group->sortBy('name');
        })->sortKeys();

        // Handle null group_name
        if ($permissionsByGroup->has(null)) {
            $ungrouped = $permissionsByGroup->pull(null);
            $permissionsByGroup->put('Ungrouped', $ungrouped);
        }

        $role->users_count = $role->users->count();
        $role->permissions_count = $role->permissions->count();

        return view('admin.roles.show', compact('role', 'permissionsByGroup'));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('group_name')
            ->orderBy('name')
            ->get()
            ->groupBy('group_name');

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        $stakeholderTypes = Role::whereNotNull('stakeholder')
            ->distinct('stakeholder')
            ->pluck('stakeholder')
            ->filter()
            ->values()
            ->all();

        return view('admin.roles.edit', compact(
            'role',
            'permissions',
            'rolePermissions',
            'stakeholderTypes'
        ));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        // Determine stakeholder value
        $stakeholder = $request->stakeholder;
        if ($stakeholder === 'custom') {
            $stakeholder = $request->custom_stakeholder;
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:500',
            'stakeholder' => 'nullable|string|max:100',
            'custom_stakeholder' => 'nullable|string|max:100',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        // Additional validation for custom stakeholder
        if ($request->stakeholder === 'custom') {
            $request->validate([
                'custom_stakeholder' => 'required|string|max:100',
            ]);
        }

        // Start transaction
        DB::beginTransaction();

        try {
            // Update role
            $role->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'stakeholder' => $stakeholder,
            ]);

            // Sync permissions if provided
            if ($request->has('permissions') && is_array($request->permissions)) {
                // Filter out any non-numeric values
                $permissionIds = array_filter($request->permissions, 'is_numeric');

                // Get only existing permission IDs from database
                $existingPermissionIds = Permission::whereIn('id', $permissionIds)
                    ->pluck('id')
                    ->toArray();

                if (!empty($existingPermissionIds)) {
                    $role->syncPermissions($existingPermissionIds);
                } else {
                    $role->syncPermissions([]);
                }
            } else {
                $role->syncPermissions([]);
            }

            DB::commit();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role "' . $role->name . '" updated successfully.')
                ->with('toast_success', 'Role updated');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Role update failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to update role. Please try again.');
        }
    }

    public function destroy(Role $role): RedirectResponse
    {
        // Check if role is assigned to any user
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete role that is assigned to users.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
