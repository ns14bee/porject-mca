<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Decease extends Model{
    
    protected $table = 'deceased_details';	
    protected $primaryKey = 'id';
    
    public function user(){
        return $this->hasOne(User::class, 'id' , 'user_id')->withTrashed();
    }
    
    public static function addDeceaseDetails($request){
        $data = new Decease();
        $data->user_id = Auth::user()->id;
        $data->deceased_number = IdGenerator::generate(['table' => 'deceased_details', 'length' =>8, 'prefix' =>config('const.deceaseNumberPrefix'),'field'=>'deceased_number']);
        $data->name = $request->name;
        $data->address = isset($request->address)?$request->address:NULL;
        $data->city = isset($request->city)?$request->city:'';
        $data->state = isset($request->state)?$request->state:'';
        if(isset($data->date_of_passing)&& $data->date_of_passing!=''){
           $data->date_of_passing = date(config('const.databaseStoredDateFormat'),strtotime($request->date_of_passing));
        }
        $data->birth_date = date(config('const.databaseStoredDateFormat'),strtotime($request->birth_date));
        $data->birth_location = $request->birth_location;
        $data->status = config('const.statusActive');
        $data->save();
        return $data;
    }
    
    public static function getDeceaseDetailsByUserID($userID){
        $data = Decease::where('user_id',$userID)->first();
        if($data){
            if($data->date_of_passing){
                $data->date_of_passing = date(config('const.displayDate'),strtotime($data->date_of_passing));
            }
            if($data->birth_date){
                $data->birth_date = date(config('const.displayDate'),strtotime($data->birth_date));
            }
        }
        return $data;
    }
    
    public static function updateDecease($id,$request){
        $data = Decease::find($id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->city = isset($request->city)?$request->city:'';
        $data->state = isset($request->state)?$request->state:'';
        if(isset($request->date_of_passing) && $request->date_of_passing!=''){
            $data->date_of_passing = date(config('const.databaseStoredDateFormat'),strtotime($request->date_of_passing));
        }else{
            $data->date_of_passing = NULL;
        }
        $data->birth_date = date(config('const.databaseStoredDateFormat'),strtotime($request->birth_date));
        $data->birth_location = $request->birth_location;
        //$data->birth_state = $request->birth_state;
        //$data->birth_city = $request->birth_city;
        $data->status = config('const.statusActive');
        $data->save();
    }
    
    
    public static function getDeceaseByUserID($userID){
        
        $deceaseData = Decease::where('user_id',$userID)->where('status',config('const.statusActive'))->first();
           if($deceaseData){
               if(isset($deceaseData->date_of_passing) && $deceaseData->date_of_passing!=''){
                $deceaseData->date_of_passing = date(config('const.displayDate') ,  strtotime($deceaseData->date_of_passing));
               }else{
                   $deceaseData->date_of_passing = NULL;
               }
               $deceaseData->birth_date = date(config('const.displayDate') ,  strtotime($deceaseData->birth_date));
           }
           
        return $deceaseData;   
    }
}
