<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';	
    protected $primaryKey = 'id';
    
    public static function getRoles(){
        if(Auth::user()->role_id==config('const.roleSubAdmin') ||  Auth::user()->role_id==config('const.roleSupport') || Auth::user()->role_id==config('const.roleDeveloper')){
            return Role::where('id','!=',1)->get();
        }else{
            return Role::all();
        }
    }
}
