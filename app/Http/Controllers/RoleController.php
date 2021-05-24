<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' =>Permission::all()

            ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }

    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isDirty('name')){
            session()->flash('role-update', 'Role has updated');
            $role->save();
        } else
        {
            session()->flash('role-update', 'Nothing has been update');
        }
        return redirect()->route('roles.index');
    }

    public function attach(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function dettach(Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('role-delete', 'Role ' . $role->name . ' has deleted');
        return back();
    }
}
