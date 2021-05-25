<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Yajra\DataTables\DataTables;
use App\Models\Department;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Support\Facades\Response;
use Validator;

class DepartmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    

    public static function postDepartmentsList(Request $request){ 
        try{
           return Department::postDepartmentsList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('department.create');
        } 
    }
    /* User Listing Start */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'dept_name' => 'required',
                'dept_description' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $dataDepartments = Department::createDepartment($request);

            session()->flash('success',  trans('messages.departmentCreated'));
            return redirect()->route('department.index');

        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('department.create');
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $userData = Department::find($id);
            $data = Department::where('id',$id)->delete();
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        }  
    }
}
