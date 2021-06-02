<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::all();
        return view('admin.roles.index',['roles'=>$roles]);

    }

    public function store(){

        request()->validate([
              'name'=>['required']  
        ]);

        Role::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::lower(request('name'))
        ]);
        Session::flash('role_created','Role is created');

        return back();
    }

    public function destroy($id){
        $role=Role::find($id);
        $role->delete();
        Session::flash('role_delete','Role Deleted');

        return back();

    }

    public function edit($id){
    $role=Role::find($id);
    $permissions=Permission::all();
    return view('admin.roles.edit',['role'=>$role,'permissions'=>$permissions]);
    }

    public function update($id){
        $role=Role::find($id);
        $role->name=Str::ucfirst(request('name'));
        $role->slug=Str::of(Str::lower(request('name')))->slug('-');     
        

        if($role->isDirty('name')){
            Session::flash('role_updated','Role has been updated');
            $role->save();

        }else{
            Session::flash('role_updated','Nothing to update');
            
        }
                
        return redirect()->route('roles.index');  
    }

    public function attach($id){
        $role=Role::find($id);
        $role->permissions()->attach(request('permission'));
        return back();

    }

    public function detach($id){
        $role=Role::find($id);
        $role->permissions()->detach(request('permission'));
        return back();
    }
}
