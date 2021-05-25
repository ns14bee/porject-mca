<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model
{
    protected $table = 'menu_permission';	
    protected $primaryKey = 'id';
    
    public static function addMenuPermissions($userID,$request){
        $UserData = User::find($userID);
        if($request->role_id !=config('const.roleSuperAdmin') &&  $request->role_id !=config('const.roleUserMaster') && $request->role_id !=config('const.roleUserInvited')){
            MenuPermission::where('user_id',$userID)->update(['read' => 0,'write' => 0]);
            if(isset($request->read) && count($request->read)>0){
                foreach($request->read as $key=>$value){
                    $data = MenuPermission::where('user_id',$userID)->where('menu_id',$key)->first();
                    if($data){
                       $data->user_id = $userID;
                       $data->menu_id = $key;
                       $data->read = 1;
                       $data->updated_at = Carbon::now();
                       $data->save();
                    }else{
                       $newMenuPermissions = new MenuPermission();
                       $newMenuPermissions->user_id = $userID;
                       $newMenuPermissions->menu_id = $key;
                       $newMenuPermissions->read = 1;
                       $newMenuPermissions->save();
                    }
                }
            }

            if(isset($request->write) && count($request->write)>0){
                foreach($request->write as $key=>$value){
                    $data = MenuPermission::where('user_id',$userID)->where('menu_id',$key)->first();
                    if($data){
                       $data->user_id = $userID;
                       $data->menu_id = $key;
                       $data->write = 1;
                       $data->updated_at = Carbon::now();
                       $data->save();
                    }else{
                       $newMenuPermissions = new MenuPermission();
                       $newMenuPermissions->user_id = $userID;
                       $newMenuPermissions->menu_id = $key;
                       $newMenuPermissions->write = 1;
                       $newMenuPermissions->save();
                    }
                }
            }
        }    
        
        
        if($request){
            if($request->role_id==config('const.roleSuperAdmin') || $request->role_id==config('const.roleUserMaster')){
                MenuPermission::where('user_id',$UserData->id)->delete();
            }
        }
        
    }
    
}
