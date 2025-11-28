<?php
// app/Http/Controllers/Admin/RoleController.php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $roles = Role::withCount(['users', 'permissions'])->latest()->paginate(20);
        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        // dd(Permission::all());
        $permissions = Permission::all()->groupBy(function ($permission) {
            // Group by first word of permission name
            return explode(' ', $permission->name)[1];
        });

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        DB::transaction(function () use ($request) {
            $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

            // Get permission names from IDs
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($permissionNames);
        });

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role): View
    {
        $role->load(['permissions', 'users']);

        // Group permissions by module/group
        $permissionsByGroup = $role->permissions->groupBy(function ($permission) {
            // Extract module name from permission name
            // Assuming permission names are like "module action" or "module submodule action"
            $parts = explode(' ', $permission->name);
            return $parts[1] ?? 'general'; // Use the second part as group name
        })->sortKeys();

        // Get users count and permissions count
        $role->users_count = $role->users->count();
        $role->permissions_count = $role->permissions->count();

        return view('admin.roles.show', compact('role', 'permissionsByGroup'));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            // Group by first word of permission name
            return explode(' ', $permission->name)[1];
        });

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        DB::transaction(function () use ($request, $role) {
            $role->update(['name' => $request->name]);

            // Get permission names from IDs
            $permissionNames = Permission::whereIn('id', $request->permissions)
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($permissionNames);
        });

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        // Prevent deletion of essential roles
        $protectedRoles = ['State Admin', 'Super Admin'];
        if (in_array($role->name, $protectedRoles)) {
            return redirect()->back()->with('error', 'This role cannot be deleted.');
        }

        // Check if role has users
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete role assigned to users.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
