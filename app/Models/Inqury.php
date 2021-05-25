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

class Inqury extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $table = 'inqury';
    protected $primaryKey = 'id';

    public static function createInqury($request){
        $data = new Inqury();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->details = $request->details;

        $data->save();
        return $data;
    }

    /* Admin Inqury List Start */
    public static function postInquryList($request){
        
        $query = Inqury::select('inqury.*');
        if($request->order ==null){
            $query->orderBy('inqury.id','desc');
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
