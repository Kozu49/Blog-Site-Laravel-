<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class PermissionController extends Controller
{
    public function index(){
        $permission=Permission::all();
        return view('admin.permissions.index',['permissions'=>$permission]);
    }

    public function store(){

        request()->validate([
              'name'=>['required']  
        ]);

        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::lower(request('name'))
        ]);
        Session::flash('permission_created','New Permission is created');

        return back();
    }

    public function destroy($id){
        $permission=Permission::find($id);
        $permission->delete();
        Session::flash('permission_delete','Permission Deleted');

        return back();

    }

    public function edit($id){

        $permissions=Permission::find($id);
        return view('admin.permissions.edit',['permission'=>$permissions]);

    }

    public function update($id){
        $permission=Permission::find($id);
        $permission->name=Str::ucfirst(request('name'));
        $permission->slug=Str::of(Str::lower(request('name')))->slug('-');     
        

        if($permission->isDirty('name')){
            Session::flash('permission_updated','permission has been updated');
            $permission->save();

        }else{
            Session::flash('permission_updated','Nothing to update');
            
        }
                
        return redirect()->route('permissions.index'); 
    }
}

