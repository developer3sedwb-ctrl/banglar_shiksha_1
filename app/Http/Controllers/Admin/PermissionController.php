<?php
// app/Http/Controllers/Admin/PermissionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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

        $permissions = Permission::withCount('roles')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(50);

        return view('admin.permissions.index', compact('permissions', 'search'));
    }

    public function create(): View
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
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
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
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
