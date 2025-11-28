<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        
    }
    
    // Show all modules
    public function index()
    {
        $modules = Module::where(['parent_module_id'=>null])->withCount('submodules')->get();
        return view('src.accesscontrol.modules.index', compact('modules'));
    }

    // Show create form
    public function create()
    {
        return view('src.accesscontrol.modules.create');
    }

    // Store new module
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('bs_modules')->where(function ($query) use ($request) {
                    return $query->where('parent_module_id', $request->parent_module_id);
                }),
            ],
            'url' => 'nullable|string',
        ]);

        $request->merge([
            'shortcode' => str_replace([' ','/','-','*'],'_', str_replace(["'",""],"",$request->name))
        ]);

        Module::create($request->only(['shortcode', 'name', 'parent_module_id', 'url']));
        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    // Show edit form
    public function edit(Module $module)
    {
        return view('src.accesscontrol.modules.edit', compact('module'));
    }

    // Update existing module
    public function update(Request $request, Module $module)
    {
        $request->validate([            
            'name' => 'required|unique:bs_modules,name,' . $module->id,
            'url' => 'nullable|string',
        ]);

        $request->merge([
            'shortcode' => str_replace([' ','/','-','*'],'_', str_replace(["'",""],"",$request->name))
        ]);

        $module->update($request->only(['shortcode', 'name', 'url']));

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }


    public function submodules(Module $module)
    {
        $submodules = Module::where('parent_module_id', $module->id)->get();
        return view('src.accesscontrol.modules.submodules', compact('module', 'submodules'));
    }

    public function submoduleEdit(Module $module)
    {
        $parentModule = Module::find($module->parent_module_id);
        return view('src.accesscontrol.modules.edit', compact('module', 'parentModule'));
    }


    public function submoduleCreate(Module $module)
    {
        return view('src.accesscontrol.modules.create', compact('module'));
    }

    public function submoduleListData($moduleId)
    {
        $submodules = Module::where('parent_module_id', $moduleId)->get();
        return response()->json($submodules);
    }
}
