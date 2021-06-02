<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view('admin.users.index',['users'=>$users]);
    }


    public function show($id){
        $user=User::findOrFail($id);
        $this->authorize('view',$user);

        return view('admin.users.profile',[
            'user'=>$user,
            'roles'=>Role::all()
            ]);


    }
    public function update($id){
        $user=User::find($id);

        $inputs=request()->validate([

            // 'username'=>['required','string','max:200','alpha_dash'],
            // 'name'=>['required','string','max:200','alpha_dash'],
            // 'email'=>['required','email','max:200'],
            // 'avatar'=>['file']
            // 'password'=>['min:6','max:255','confirmed']

            'username'=>'required|min:8|max:200',
            'name'=>'required|string|min:8|max:200',
            'email'=>'required|email',
            'avatar'=>'file',
            // 'password'=>'min:5|max:200'
            
            
            ]);
    
        if(request('avatar')){
            $inputs['avatar']=request('avatar')->store('images');
            $user->avatar=$inputs['avatar'];
        }
        $user->username=$inputs['username'];
        $user->name=$inputs['name'];
        $user->email=$inputs['email'];
        // $user->password=$inputs['password'];

        $user->save();
        return back();
        // return redirect()->route('users.index');    
    
    }

    

    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        Session::flash('user_deleted','User has been deleted');

        return back();


    }

    public function attach($id){
        $user=User::find($id);
        $user->roles()->attach(request('role'));
        return back();


    }

    public function detach($id){
        $user=User::find($id);
        $user->roles()->detach(request('role'));
        return back();


    }
}
