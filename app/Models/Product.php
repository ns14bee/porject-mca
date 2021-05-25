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

class Product extends Model
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';

    public static function createProduct($request){
        $data = new Product();
        $data->name = $request->name;

        $bannerlogoName = $data->image;
        if(isset($request->image) && $request->image !=''){
            
            /* Unlink Image */
            if(isset($data->image) && $data->image!=''){
                $imagePath = Helper::DataProductUploadPath().''.$data->image;
                if(file_exists($imagePath)){
                    unlink($imagePath);    
                }
            }
            
            $profilelogo   = $request->image;
            $bannerlogoName = 'Product-'.time().'.'.$request->image->getClientOriginalExtension();
            $profilelogo->move(Helper::DataProductUploadPath(), $bannerlogoName);    
        }
        $data->image = $bannerlogoName;
        
        $data->description = $request->description;
        $data->price = $request->price;
        $data->brand = $request->brand;
        $data->installation_type = $request->installation_type;
        $data->industry = $request->industry;
        $data->water_source = $request->water_source;
        $data->water_storage_capacity = $request->water_storage_capacity;
        $data->working_pressure = $request->working_pressure;
        $data->capacity = $request->capacity;
        $data->usage_application = $request->usage_application;
        $data->product_range = $request->product_range;
        $data->flow_rate = $request->flow_rate;
        $data->voltage = $request->voltage;
        $data->frequency = $request->frequency;
        $data->frequency_range = $request->frequency_range;
        $data->power_source = $request->power_source;
        $data->minimum_order_quantity = $request->minimum_order_quantity;
        $data->material = $request->material;
        $data->purification_capacity = $request->purification_capacity;
        $data->type_of_purification_plants = $request->type_of_purification_plants;
        $data->capacity_inlet_flow_rate = $request->capacity_inlet_flow_rate;
        $data->water_yield = $request->water_yield;
        $data->phase = $request->phase;
        $data->recovery = $request->recovery;
        $data->desalination_rate = $request->desalination_rate;
        $data->quality = $request->quality;
        $data->colour = $request->colour;
        $data->size_dimension = $request->size_dimension;
        $data->sterilization_for = $request->sterilization_for;
        $data->service_location = $request->service_location;
        $data->service_mode = $request->service_mode;
        $data->service_duration = $request->service_duration;

        $data->save();
        return $data->id;
    }

    /* Admin Products List Start */
    public static function postProductList($request){
        
        $query = Product::select('products.*');
        if($request->order ==null){
            $query->orderBy('products.id','desc');
        }
      
        return Datatables::of($query)
            ->addColumn('image', function ($data) {
                return Helper::displayProductPath().$data->image;       
            }) 
            ->addColumn('action', function ($data) {
               $userPer = Helper::getMenuPermission(1,Auth::user()->id);
               $recoverylink = '';
               if(Auth::user()->role_id == config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1)){
                    $editLink = URL::to('/').'/admin/product/'.$data->id.'/edit';
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
               $viewLink = URL::to('/').'/admin/product/'.$data->id;
               
               return Helper::Action($editLink,$deleteLink,$viewLink,$recoverylink);   
            }) 
            ->rawColumns(['action'])
            ->make(true);
    }

    public static function editProduct($id,$request){
        $data = Product::find($id);
        $data->name = $request->name;

        $bannerlogoName = $data->image;
        if(isset($request->image) && $request->image !=''){
            
            /* Unlink Image */
            if(isset($data->image) && $data->image!=''){
                $imagePath = Helper::DataProductUploadPath().''.$data->image;
                if(file_exists($imagePath)){
                    unlink($imagePath);    
                }
            }
            
            $profilelogo   = $request->image;
            $bannerlogoName = 'Product-'.time().'.'.$request->image->getClientOriginalExtension();
            $profilelogo->move(Helper::DataProductUploadPath(), $bannerlogoName);    
        }
        $data->image = $bannerlogoName;
        
        $data->description = $request->description;
        $data->price = $request->price;
        $data->brand = $request->brand;
        $data->installation_type = $request->installation_type;
        $data->industry = $request->industry;
        $data->water_source = $request->water_source;
        $data->water_storage_capacity = $request->water_storage_capacity;
        $data->working_pressure = $request->working_pressure;
        $data->capacity = $request->capacity;
        $data->usage_application = $request->usage_application;
        $data->product_range = $request->product_range;
        $data->flow_rate = $request->flow_rate;
        $data->voltage = $request->voltage;
        $data->frequency = $request->frequency;
        $data->frequency_range = $request->frequency_range;
        $data->power_source = $request->power_source;
        $data->minimum_order_quantity = $request->minimum_order_quantity;
        $data->material = $request->material;
        $data->purification_capacity = $request->purification_capacity;
        $data->type_of_purification_plants = $request->type_of_purification_plants;
        $data->capacity_inlet_flow_rate = $request->capacity_inlet_flow_rate;
        $data->water_yield = $request->water_yield;
        $data->phase = $request->phase;
        $data->recovery = $request->recovery;
        $data->desalination_rate = $request->desalination_rate;
        $data->quality = $request->quality;
        $data->colour = $request->colour;
        $data->size_dimension = $request->size_dimension;
        $data->sterilization_for = $request->sterilization_for;
        $data->service_location = $request->service_location;
        $data->service_mode = $request->service_mode;
        $data->service_duration = $request->service_duration;

        $data->save();
        return $data->id;
    }
}
