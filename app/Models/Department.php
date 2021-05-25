<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use URL;
use App\Helpers\Helper;
use App\Password_Resets;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $table = 'department';
    protected $primaryKey = 'id';

    public static function createDepartment($request){
        $data = new Department();
        $data->dept_name = $request->dept_name;
        $data->dept_description = $request->dept_description;

        $data->save();
        return $data->id;
    }

    /* Admin Departments List Start */
    public static function postDepartmentsList($request){
        
        $query = Department::select('department.*');
        if($request->order ==null){
            $query->orderBy('department.id','desc');
        }
        
        $searcharray = array();    	
    	parse_str($request->fromValues,$searcharray);
      
        return Datatables::of($query)
            ->addColumn('action', function ($data) {
               $userPer = Helper::getMenuPermission(1,Auth::user()->id);
               $recoverylink = '';
               if(Auth::user()->role_id == config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1)){
                   $editLink = '';
                   $deleteLink = $data->id;
                   if($data->role_id == config('const.roleEmployee')){
                       $recoverylink = $data->id;
                   }
               }else{
                   $editLink = '';
                   $deleteLink = '';
                   $recoverylink = '';
               }
               if($data->role_id==config('const.roleAdmin')){
                   $editLink = '';
                   $deleteLink = '';
                   $recoverylink = '';
               }
               $viewLink = '';
               
               return Helper::Action($editLink,$deleteLink,$viewLink,$recoverylink);   
            }) 
            ->rawColumns(['action'])
            ->make(true);
    }
}
