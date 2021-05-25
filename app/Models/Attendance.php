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
use App\Models\Leave;


class Attendance extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;
    //
    
    protected $table = 'attendances';	
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'entry_time','status'];    
    protected $dates = ['created_at','updated_at'];

    /* Attendance List Start */
    public static function postAttendanceList($request){
        
        $employee_user = Auth::user()->id;
        $query = Attendance::where('user_id',$employee_user)->get();
        return Datatables::of($query)
        ->addColumn('status', function ($data) {
            return Helper::AttendanceStatus($data);
        })
        ->rawColumns(['status'])
        ->make(true);
    }    

    public static function activeAttenceCount(){
        $employee_user = Auth::user()->id;
        $query = Attendance::where('user_id',$employee_user);
        return $query->count();
    }

    public static function activeLeaveCount(){
        $employee_user = Auth::user()->id;
        $query = Leave::where(['user_id'=>$employee_user,'status'=>'approve']);
        return $query->count();
    }

    /* Daysheet List Start */
    public static function postDaySheetsList($request){

        $query = User::select('users.*','attendances.entry_time as attendances_entrytime','attendances.exit_time as attendances_exittime')
        ->leftJoin('attendances', 'attendances.user_id', '=', 'users.id')
        ->with('getdepartmentusers','getroleusers')
        ->where(['role_id'=>2])->get();

        return Datatables::of($query)
        ->make(true);
    }   
}
