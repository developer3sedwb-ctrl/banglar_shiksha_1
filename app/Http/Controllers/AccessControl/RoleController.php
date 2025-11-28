<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    protected $roleTbl = 'bs_roles';
    public function __construct()
    {

        // $this->middleware('auth');
    }
    
    // Show all roles
    public function index()
    {
        $roles = Role::all();
        return view('src.accesscontrol.roles.index', compact('roles'));
    }

    // Show create form
    public function create()
    {
        $users = User::all();
        return view('src.accesscontrol.roles.create', compact('users'));
    }

    // Store new role
    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|integer|unique:'.$this->roleTbl.',userid',
            'shortcode' => 'required|unique:'.$this->roleTbl.',shortcode',
            'name' => 'required|unique:'.$this->roleTbl.',name',
        ]);

        Role::create($request->only(['userid', 'shortcode', 'name']));
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Show edit form
    public function edit(Role $role)
    {
        return view('src.accesscontrol.roles.edit', compact('role'));
    }

    // Update existing role
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'userid' => 'required|unique:'.$this->roleTbl.',userid,' . $role->id,
            'shortcode' => 'required|unique:'.$this->roleTbl.',shortcode,' . $role->id,
            'name' => 'required|unique:'.$this->roleTbl.',name,' . $role->id,
        ]);

        $role->update($request->only(['userid', 'shortcode', 'name']));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
}
