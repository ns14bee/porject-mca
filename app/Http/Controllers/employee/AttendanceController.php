<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Support\Facades\Response;

use Carbon\Carbon;

class AttendanceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee_user = Auth::user()->id;
        $attendance = Attendance::where('user_id',$employee_user)->orderBy('created_at', 'desc')->take(1)->get();
        $employee = User::where('id',$employee_user)->first()->toarray();
        $data = [
            'employee' => $employee,
            'attendance' => null,
            'registered_attendance' => null
        ];
        $last_attendance = Attendance::where('user_id',$employee_user)->orderBy('created_at', 'desc')->take(1)->first();
        if($last_attendance) {
            if($last_attendance->created_at->format('d') == Carbon::now()->format('d')){
                $data['attendance'] = $last_attendance;
                if($last_attendance->registered){
                    $data['registered_attendance'] = 'yes';
                }
            }
        }

        return view('employee.attendance.index')->with($data);
    }

    public function postAttendanceList(Request $request){
        try{
            return Attendance::postAttendanceList($request);
         }catch(\Exception $e){
             session()->flash('error',$e->getMessage());
             return redirect()->route('attendance.list');
         }
    }

    public function list()
    {
        return view('employee.attendance.listing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$employee_id)
    {
        $attendance = new Attendance([
            'user_id' => $employee_id,
            'registered' => 'yes',
            'status' => 'Present'
        ]);

        $attendance->save();
        $request->session()->flash('success', 'Attendance entry successfully logged');
        return redirect()->route('attendance.index')->with('employee', Auth::user()->employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $attendance_id)
    {
        $attendance = Attendance::findOrFail($attendance_id);
        $attendance->registered = 'yes';
        $attendance->exit_time = Carbon::now();
        
        $attendance->save();
        $request->session()->flash('success', 'Attendance exit successfully logged');
        return redirect()->route('attendance.index')->with('employee', Auth::user()->employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
