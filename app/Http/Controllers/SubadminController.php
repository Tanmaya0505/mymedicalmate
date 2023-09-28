<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\User;

use Illuminate\Support\Facades\Hash;
class SubadminController extends Controller
{
  public function index(){

      $data = User::where('user_type',2)->get();
        
      return view('pages.subadmin.index',compact('data'));
    }

    public function add(){

      $roles = Role::get();
        
      return view('pages.subadmin.add',compact('roles'));
    }
    public function store(Request $request){
    	if($request->sub_admin_id){
        $request->validate([
          'email' => 'required|email|unique:users,email,'. $request->sub_admin_id,
          'name' => 'required',
          //'password' => 'required',
          'user_role' => 'required'
        ]);

      }else{
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required',
            'user_role' => 'required'
        ]);
      }
      if($request->sub_admin_id){
      	$subadmin = User::find($request->sub_admin_id);
        if($request->password != ""){
          $subadmin->password = Hash::make($request->password);
          $subadmin->user_password = $request->password;
        }
      }else{
      	$subadmin = new User();
        $subadmin->password = Hash::make($request->password);
        $subadmin->user_password = $request->password;
      }
      $subadmin->name = $request->name;
      $subadmin->email = $request->email;
      $subadmin->user_role = $request->user_role;
      $subadmin->user_type = 2;
      
      $subadmin->save();
        
      return redirect('/cms-admin/sub-admin');
    }
    public function edit(Request $request,$id){

      
       	$data = User::find($id); 
      	$roles = Role::get();
        
      return view('pages.subadmin.edit',compact('roles','data'));
    }
    public function delete(Request $request,$id){
    	$data = User::find($id)->delete(); 
      
        
      return redirect('/cms-admin/sub-admin');
    }
    
}
