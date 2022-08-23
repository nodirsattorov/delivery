<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->can('roles.show'),403);

        $roles = Role::with('permissions')->get();

        if (!auth()->user()->can('super.admin'))
            $roles = $roles->where('name','!=','Admin')->all();

        return view('pages.roles.index',compact('roles'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->get('name'),
            'title' => $request->get('title')
        ]);



        $permissions = $request->get('permissions');
        if ($permissions)
        {
            foreach ($permissions as $key => $item) {
                $role->givePermissionTo($item);
            }
        }

        return redirect()->route('roleIndex');
    }


    public function add()
    {
        if (!auth()->user()->can('roles.add'))
            return abort(404);

        $permissions = Permission::all();

        if (!auth()->user()->can('super.admin'))
            $permissions = $permissions->whereNotIn('name',[
                'super.admin',
                'permission.edit',
                'permission.edit',
                'permission.add',
                'permission.delete',
                'roles.edit',
                'roles.delete',
                'user.edit',
                'user.add',
                'user.delete'

            ])->all();

        return view('pages.roles.add',compact('permissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('roles.edit'))
            return abort(404);

        $role = Role::findById($id);
        $permissions = Permission::all();

        if (!auth()->user()->can('super.admin'))
            $permissions = $permissions->whereNotIn('name',[
                'super.admin',
                'permission.edit',
                'permission.edit',
                'permission.add',
                'permission.delete',
                'roles.edit',
                'roles.delete',
                'user.edit',
                'user.add',
                'user.delete'

            ])->all();

        return view('pages.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|unique:roles,name,'.$id
        ]);
        $permissions = $request->get('permissions');
        unset($request['permissions']);
        $role = Role::findById($id);
        $role->fill($request->all());
        $role->syncPermissions($permissions);
        $role->save();

        return redirect()->route('roleIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('roles.delete'))
            return abort(404);
        $role = Role::findById($id);
        $role->delete();
        return redirect()->back();
    }
}
