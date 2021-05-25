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

class Blog extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $table = 'blogs';
    protected $primaryKey = 'id';

    public static function createBlog($request){
        $data = new Blog();
        $data->title = $request->title;
        $data->description = $request->description;

        $imageName = $data->image;
        if(isset($request->image) && $request->image !=''){

            $image   = $request->image;
            $imageName = 'image-'.time().'.'.$request->image->getClientOriginalExtension();
            $image->move(Helper::BlogimageFileUploadPath(), $imageName);    
        }
        $data->image = $imageName;

        $data->save();
        return $data->id;
    }

    /* Admin Blogs List Start */
    public static function postblogList($request){
        
        $query = Blog::select('blogs.*');
        if($request->order ==null){
            $query->orderBy('blogs.id','desc');
        }
        
        $searcharray = array();    	
    	parse_str($request->fromValues,$searcharray);
      
        return Datatables::of($query)
            ->addColumn('image', function ($data) {
                return Helper::displayBlogimagePath().$data->image;       
            }) 
            ->addColumn('action', function ($data) {
               $userPer = Helper::getMenuPermission(1,Auth::user()->id);
               $recoverylink = '';
               if(Auth::user()->role_id == config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1)){
                    $editLink = URL::to('/').'/admin/blog/'.$data->id.'/edit';
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
            ->rawColumns(['image','action'])
            ->make(true);
    }

    public static function editBlog($id,$request){
        $data = Blog::find($id);
        $data->title = $request->title;
        $data->description = $request->description;

        $imageName = $data->image;
        if(isset($request->image) && $request->image !=''){

            /* Unlink image */
            if(isset($data->image) && $data->image!=''){
                $imagePath = Helper::BlogimageFileUploadPath().''.$data->image;
                if(file_exists($imagePath)){
                    unlink($imagePath);    
                }
            }

            $image  = $request->image;
            $imageName = 'image-'.time().'.'.$request->image->getClientOriginalExtension();
            $image->move(Helper::BlogimageFileUploadPath(), $imageName);    
        }
        $data->image = $imageName;

        $data->save();
        return $data->id;  

    }
}