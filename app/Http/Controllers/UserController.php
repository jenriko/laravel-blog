<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        $users = User::all();
        return view('admin.users.index',['users' => $users]);
    }


    public function show(User $user){
        return view('admin.users.profile', [
            'user'=>$user,
            'roles'=>Role::all()
        ]);

    }

    public function update(User $user){
    
    $inputs = request()->validate([

        'username' => ['required','string','max:255', 'alpha_dash','unique:users,username,'.$user->id],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
        'avatar' => ['sometimes','nullable', 'mimes:jpeg,jpg,png,gif|max:2040']
        // 'password' => ['sometimes', 'nullable', 'min:6', 'max:25', 'confirmed']
        
    ]);

        if (request('avatar')) {
            \Storage::delete($user->avatar);
            $inputs['avatar'] = request('avatar')->store('images');
        // }
        // if(request('password')){
        //     $inputs['password'] = bcrypt(request('password'));
        }
        $user->update($inputs);
        return back();
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }

    public function destroy(User $user){
        $user->delete();
        session()->flash('user-delete','User has been deleted');
        return back();
    }

}
