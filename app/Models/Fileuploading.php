<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use URL;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class Fileuploading extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $table = 'file_uploading';
    protected $primaryKey = 'id';

    public static function createFileuploading($request){
        $data = new Fileuploading();
        $data->title = $request->title;
        $data->user_id = Auth::user()->id;

        $file_uploadName = $data->file_upload;
        if(isset($request->file_upload) && $request->file_upload !=''){

            $file_upload   = $request->file_upload;
            $file_uploadName = 'file_upload-'.time().'.'.$request->file_upload->getClientOriginalExtension();
            $file_upload->move(Helper::DataFileUploadPath(), $file_uploadName);    
        }
        $data->file_upload = $file_uploadName;

        $data->save();
        return $data->id;
    }

    /* Admin file_uploading List Start */
    public static function postfileuploadingList($request){
        
        $user_permission_id = Auth::user()->id;
        $query = Fileuploading::where('user_id',$user_permission_id)->get();        
        $searcharray = array();    	
    	parse_str($request->fromValues,$searcharray);
      
        return Datatables::of($query)
            ->addColumn('file_upload', function ($data) {
                return Helper::displayFilePath().$data->file_upload;       
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
            ->rawColumns(['file_upload','action'])
            ->make(true);
    }
}