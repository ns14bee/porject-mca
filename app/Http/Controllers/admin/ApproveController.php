<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Helpers\Helper;
use App\Models\Attendance;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Support\Facades\Response;

class ApproveController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.approve.listing');
    }

    /* Admin Leave List Start */
    public static function postApproveList(Request $request){
        $query = Leave::select('leaves.*','users.name as user_name') 
        ->leftJoin('users', 'leaves.user_id', '=', 'users.id')
        ->get();

        return Datatables::of($query)
            ->addColumn('status', function ($data) {
                return Helper::LeaveStatus($data);
            })
            ->addColumn('leave_type', function ($data) {
                return Helper::LeaveType($data);
            })
            ->addColumn('permission', function ($data) {
               $userPer = Helper::getMenuPermission(1,Auth::user()->id);
               if(Auth::user()->role_id == config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1)){
                    $approveLink = $data->id;
                    $rejectLink = $data->id;
               }else{
                    $approveLink = '';
                    $rejectLink = '';
               }
               if($data->role_id==config('const.roleAdmin')){
                    $approveLink = '';
                    $rejectLink = '';
               }               
               return Helper::LeaveAction($approveLink,$rejectLink);   
            }) 
            ->rawColumns(['status','leave_type','permission'])
            ->make(true);
    }

    public function approveLeave($id)
    {
        try{
            $data = Leave::where('id',$id)->update(['status'=>'approve']);
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        }
    }

    public function rejectLeave($id)
    {
        try{
            $data = Leave::where('id',$id)->update(['status'=>'reject']);
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        }
    }
}
