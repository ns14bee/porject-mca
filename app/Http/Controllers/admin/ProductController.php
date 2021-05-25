<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Validator;
use App\Helpers\Helper;
use App\Models\Blog;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
                'name' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg',
                'description' => 'required',
                'price' => 'required',
                'brand' => 'required',
                'installation_type' => 'required',
                'industry' => 'required',
                'water_source' => 'required',
                'water_storage_capacity' => 'required',
                'working_pressure' => 'required',
                'capacity' => 'required',
                'usage_application' => 'required',
                'product_range' => 'required',
                'flow_rate' => 'required',
                'voltage' => 'required',
                'frequency' => 'required',
                'frequency_range' => 'required',
                'power_source' => 'required',
                'minimum_order_quantity' => 'required',
                'material' => 'required',
                'purification_capacity' => 'required',
                'type_of_purification_plants' => 'required',
                'capacity_inlet_flow_rate' => 'required',
                'water_yield' => 'required',
                'phase' => 'required',
                'recovery' => 'required',
                'desalination_rate' => 'required',
                'quality' => 'required',
                'colour' => 'required',
                'size_dimension' => 'required',
                'sterilization_for' => 'required',
                'service_location' => 'required',
                'service_mode' => 'required',
                'service_duration' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $dataproducts = Product::createProduct($request);
            
            session()->flash('success',  trans('messages.productCreated'));
            return redirect()->route('product.index');

        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('product.create');
        }
    }

    public static function postProductList(Request $request){ 
        try{
           return Product::postProductList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('product.create');
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
        try{
            $data = Product::find($id);
            return view('admin.product.show',compact('data'));
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('product.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data = Product::find($id);
            return view('admin.product.edit',compact('data'));
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return redirect()->route('product.edit',$id);
        }
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
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'mimes:jpeg,png,jpg',
                'description' => 'required',
                'price' => 'required',
                'brand' => 'required',
                'installation_type' => 'required',
                'industry' => 'required',
                'water_source' => 'required',
                'water_storage_capacity' => 'required',
                'working_pressure' => 'required',
                'capacity' => 'required',
                'usage_application' => 'required',
                'product_range' => 'required',
                'flow_rate' => 'required',
                'voltage' => 'required',
                'frequency' => 'required',
                'frequency_range' => 'required',
                'power_source' => 'required',
                'minimum_order_quantity' => 'required',
                'material' => 'required',
                'purification_capacity' => 'required',
                'type_of_purification_plants' => 'required',
                'capacity_inlet_flow_rate' => 'required',
                'water_yield' => 'required',
                'phase' => 'required',
                'recovery' => 'required',
                'desalination_rate' => 'required',
                'quality' => 'required',
                'colour' => 'required',
                'size_dimension' => 'required',
                'sterilization_for' => 'required',
                'service_location' => 'required',
                'service_mode' => 'required',
                'service_duration' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $updateproducts = Product::editProduct($id,$request);
            
            session()->flash('success',  trans('messages.productUpdate'));
            return redirect()->route('product.index');

        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('product.create');
        }
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
            $data = Product::where('id',$id)->delete();
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        } 
    }
}
