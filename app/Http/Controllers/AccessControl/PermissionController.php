<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with(['role', 'module', 'submodule'])->get();
        return view('src.accesscontrol.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $roles = Role::all();
        $modules = Module::where(['parent_module_id' => null])->get();
        return view('src.accesscontrol.permissions.create', compact('roles', 'modules'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'can_view_module' => $request->has('can_view_module')
        ]);

        $request->validate([
            'role_id' => 'required|exists:bs_roles,id',
            'module_id' => 'required|exists:bs_modules,id',
            'submodule_id' => 'required|exists:bs_modules,id',
            'can_view_module' => 'boolean',
        ]);

        Permission::create([
            'role_id' => $request->role_id,
            'module_id' => $request->module_id,
            'submodule_id' => $request->submodule_id,
            'can_view_module' => $request->can_view_module
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        $modules = Module::where(['parent_module_id' => null])->get();
        return view('src.accesscontrol.permissions.edit', compact('permission', 'roles', 'modules'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->merge([
            'can_view_module' => $request->has('can_view_module')
        ]);
        $request->validate([
            'role_id' => 'required|exists:bs_roles,id',
            'module_id' => 'required|exists:bs_modules,id',
            'can_view_module' => 'nullable|boolean',
        ]);

        $permission->update([
            'role_id' => $request->role_id,
            'module_id' => $request->module_id,
            'can_view_module' => $request->has('can_view_module'),
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }

    // public function dynamicMenu(Request $request)
    // {
    //     $user_id = 192203;
    //     $user_id = 19110109;
    //     $role = Role::where('userid', $user_id)->first();
    //     $permissions = Permission::with(['module', 'submodule'])
    //         ->where('role_id', $role->id)
    //         ->where('can_view_module', true)
    //         ->get();

    //     $modules = $permissions->groupBy(function ($permission) {
    //         return $permission->module->name ?? 'Unknown Module';
    //     })->map(function ($group) {
    //         return $group->map(function ($permission) {
    //             return $permission->submodule->name ?? null;
    //         })->filter()->values();
    //     });
        
    //     return response()->json($modules);
    // }
}
