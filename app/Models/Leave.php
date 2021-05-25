<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\Helper;
use Yajra\DataTables\DataTables;
use App\Models\User;
use URL;

class Leave extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $table = 'leaves';	
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function createLeave($request){
        $data = new Leave();
        $data->reason = $request->reason;
        $data->leave_type = $request->leave_type;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->description = $request->description;
        $data->user_id = Auth::user()->id;
        $data->status = config('const.statusPending');;

        $data->save();
        return $data->id;
    }

    /* Employee Leave List Start */
    public static function postLeaveList($request){
        
        $employee_user = Auth::user()->id;
        $query = Leave::select('leaves.*')->where('user_id',$employee_user)->get();

        return Datatables::of($query)
            ->addColumn('status', function ($data) {
                return Helper::LeaveStatus($data);
            })
            ->addColumn('leave_type', function ($data) {
                return Helper::LeaveType($data);
            })
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
            ->rawColumns(['status','leave_type','action'])
            ->make(true);
    }
}
