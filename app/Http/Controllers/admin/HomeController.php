<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\BaseController;
use PDF;
use Auth;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\User;


class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }
    
    public function notFound(Request $request){
        return view('admin.errors.404');
    }

    public function exceptions(Request $request){
        return view('admin.errors.500');
    }

    public function unauthorized(Request $request){
        return view('admin.errors.401');
    }
    
    /* Set Time Zone in Sesstion For date display USE Start*/
    public function settimezone(Request $request){
        $data = $request->all();
        session()->put('customTimeZone',$data['timezone']);
    }
    /* Set Time Zone in Sesstion For date display USE End*/
    
    public function index(){
        if(Auth::user()->role_id==config('const.roleAdmin')){
            $data_total = new \stdClass();
            $data_total->data_total_Receptions = User::activeDepartmentReceptionsCount();
            $data_total->data_total_Projects = User::activeDepartmentProjectsCount();
            $data_total->data_total_Marketing = User::activeDepartmentMarketingCount();
            $data_total->data_total_Account = User::activeDepartmentAccountCount();

            return view('admin.dashboard.dashboard',compact('data_total'));
        }
        if(Auth::user()->role_id==config('const.roleEmployee')){
            $data_total = new \stdClass();
            $data_total->data_total_attendance = Attendance::activeAttenceCount();
            $data_total->data_total_leave = Attendance::activeLeaveCount();
            $user_data_deptName = User::where('id',Auth::user()->id)->first();
            $dept_name_data = Department::where('id',$user_data_deptName->department_id)->first();
            return view('employee.dashboard.dashboard',compact('dept_name_data','data_total'));
        }
    }
}
