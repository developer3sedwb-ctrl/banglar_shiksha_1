<?php
// app/Http\Controllers/Admin/PermissionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permissions', ['only' => ['index', 'show']]);
        $this->middleware('permission:create permissions', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit permissions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete permissions', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $groupFilter = $request->get('group');

        $permissions = Permission::withCount('roles')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($groupFilter, function($query) use ($groupFilter) {
                return $query->where('group_name', $groupFilter);
            })
            ->latest()
            ->paginate(50);

        // Get all unique group names for filter dropdown
        $groups = Permission::select('group_name')
            ->whereNotNull('group_name')
            ->distinct()
            ->orderBy('group_name')
            ->pluck('group_name');

        // Common permission groups for suggestions
        $commonGroups = [
            'User Management',
            'Role Management',
            'Permission Management',
            'Content Management',
            'Settings',
            'Reports',
            'Dashboard',
            'System'
        ];

        return view('admin.permissions.index', compact('permissions', 'search', 'groupFilter', 'groups', 'commonGroups'));
    }

    public function create(): View
    {
        // Get existing groups for dropdown
        $groups = Permission::select('group_name')
            ->whereNotNull('group_name')
            ->distinct()
            ->orderBy('group_name')
            ->pluck('group_name');

        $commonGroups = [
            'User Management',
            'Role Management',
            'Permission Management',
            'Content Management',
            'Settings',
            'Reports',
            'Dashboard',
            'System'
        ];

        return view('admin.permissions.create', compact('groups', 'commonGroups'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'group_name' => 'nullable|string|max:100',
        ]);

        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'guard_name' => 'web'
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission): View
    {
        $permission->load('roles');
        $roles = Role::withCount('permissions')->get();

        return view('admin.permissions.show', compact('permission', 'roles'));
    }

    public function edit(Permission $permission): View
    {
        // Get existing groups for dropdown
        $groups = Permission::select('group_name')
            ->whereNotNull('group_name')
            ->distinct()
            ->orderBy('group_name')
            ->pluck('group_name');

        $commonGroups = [
            'User Management',
            'Role Management',
            'Permission Management',
            'Content Management',
            'Settings',
            'Reports',
            'Dashboard',
            'System'
        ];

        return view('admin.permissions.edit', compact('permission', 'groups', 'commonGroups'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'group_name' => 'nullable|string|max:100',
        ]);

        $permission->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        // Check if permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete permission that is assigned to roles.');
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
