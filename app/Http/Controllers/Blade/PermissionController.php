<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class PermissionController extends Controller
{
    /**
     * CRUD of permissions
     */
    // list of permissions
    public function index()
    {
        abort_if(!auth()->user()->can('permission.show'),403,'Permission denied!');

        $permissions = Permission::with('roles')->get();

        if (!auth()->user()->can('super.admin'))
            $permissions = $permissions->where('name','!=','super.admin')->all();

        return view('pages.permissions.index',compact('permissions'));
    }

    // add permission page
    public function add()
    {
        if (!auth()->user()->can('permission.add'))
            return abort(404);

        return view('pages.permissions.add');
    }

    //create permission
    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:permissions'
        ]);

        Permission::create([
            'name' => $request->get('name'),
            'title' => $request->get('title')
        ]);

        return redirect()->route('permissionIndex');
    }

    // edit page
    public function edit($id)
    {
        if (!auth()->user()->can('permission.edit'))
            return abort(404);

        $permission = Permission::findById($id);

        if (!auth()->user()->can('super.admin'))
            $permission = $permission->where('name','!=','super.admin')->all();

        return view('pages.permissions.edit',compact('permission'));
    }

    // update data
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|unique:permissions,name,'.$id
        ]);

        $permission = Permission::findById($id);
        $permission->name = $request->get('name');
        if ($request->has('title'))
        {
            $permission->title = $request->get('title');
        }
        $permission->save();

        return redirect()->route('permissionIndex');
    }

    // delete permission
    public function destroy($id)
    {
        if (!auth()->user()->can('permission.delete'))
            return abort(404);

        $permission = Permission::findById($id);
        $permission->delete();
        return redirect()->back();
    }
}
