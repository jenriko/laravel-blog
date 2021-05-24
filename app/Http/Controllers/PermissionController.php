<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index',[
            'permissions' =>Permission::all()
        ]);
    }
    public function store(){
        request()->validate([
            'name' =>['required']
        ]);
        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        session()->flash('permission-create', 'Permission has been created');

        
        return back();
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit',[
            'permission' => $permission,
        ]);
    }

    public function update(Permission $permission){
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($permission->isDirty('name')) {
            session()->flash('permission-update', 'Permissions has been updated');
            $permission->save();
        } else {
            session()->flash('permission-update', 'Nothing has been update');
        }
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission){
        $permission->delete();

        session()->flash('permission-delete', 'Permission has been deleted');
        return back();
        
    }
}
