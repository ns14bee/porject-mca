<?php

namespace App\Http\Controllers;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Validator;
use App\Helpers\Helper;
use App\Models\Fileuploading;
use Yajra\DataTables\DataTables;

class FileUploadingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fileuploading.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fileuploading.create');
    }

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
                'title' => 'required',
                'file_upload' => 'required|mimes:jpeg,png,jpg,doc,docx,ppt,pptx,pdf,xls,xlsx',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            
            $createFileuploading = Fileuploading::createFileuploading($request);

            session()->flash('success',  trans('messages.fileuploadingCreated'));
            return redirect()->route('fileuploading.index');
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    public static function postfileuploadingList(Request $request){ 
        try{
           return Fileuploading::postfileuploadingList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('fileuploading.index');
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
            $data = Fileuploading::where('id',$id)->delete();
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        }
    }
}
