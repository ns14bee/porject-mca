<?php
use Request as Input; ?>
@extends('layouts.master')
@section('title','Product Details')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('product.index')}}"><h3 class="kt-subheader__title">Product</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Product Details</span>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="padding-top:0px!important;">

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a  class="kt-widget__username">
                                            {{$data->name}}
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                        @if($data->role_id !=config('const.roleAdmin'))
                                            <div class="kt-widget__action">
                                                <button type="button" class="btn btn-brand btn-sm btn-upper">₹ {{$data->price}}</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a><i class="fa fa-bookmark"></i>{{$data->brand}}</a>
                                        <a><i class="fa fa-database"></i>{{ucfirst($data->water_source)}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget__content">
                    <hr>
                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Installation type: </strong></label>
                                    <br><label>{{$data->installation_type}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Industry: </strong></label>
                                    <br><label>{{$data->industry}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Water Storage Capacity: </strong></label>
                                    <br><label>{{$data->water_storage_capacity}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Working Pressure: </strong></label>
                                    <br><label>{{$data->working_pressure}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Installation type: </strong></label>
                                    <br><label>{{$data->installation_type}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Capacity: </strong></label>
                                    <br><label>{{$data->capacity}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Usage Application: </strong></label>
                                    <br><label>{{$data->usage_application}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Product Range: </strong></label>
                                    <br><label>{{$data->product_range}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Flow Rate: </strong></label>
                                    <br><label>{{$data->flow_rate}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Voltage: </strong></label>
                                    <br><label>{{$data->voltage}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Frequency: </strong></label>
                                    <br><label>{{$data->frequency}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Industry: </strong></label>
                                    <br><label>{{$data->industry}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Frequency Range: </strong></label>
                                    <br><label>{{$data->frequency_range}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Power Source: </strong></label>
                                    <br><label>{{$data->power_source}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Minimum Order Quantity: </strong></label>
                                    <br><label>{{$data->minimum_order_quantity}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Material: </strong></label>
                                    <br><label>{{$data->material}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Purification Capacity: </strong></label>
                                    <br><label>{{$data->purification_capacity}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Type Of Purification Plants: </strong></label>
                                    <br><label>{{$data->type_of_purification_plants}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Capacity Inlet Flow Rate: </strong></label>
                                    <br><label>{{$data->capacity_inlet_flow_rate}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Water Yield: </strong></label>
                                    <br><label>{{$data->water_yield}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Phase: </strong></label>
                                    <br><label>{{$data->phase}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Recovery: </strong></label>
                                    <br><label>{{$data->recovery}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Desalination Rate: </strong></label>
                                    <br><label>{{$data->desalination_rate}}</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><strong>Quality: </strong></label>
                                    <br><label>{{$data->quality}}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="kt-widget__subhead row" style="margin-left: 35px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Description: </strong></label>
                                    <br><label>{{$data->description}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>image: </strong></label>
                                    <br><label><img height="150" width="140" src="<?php $image_data = App\Helpers\Helper::displayProductPath().$data->image; echo $image_data;?>" alt="{{$data->image}}"></label>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile3-->
            </div>
        </div>
    </div>
    <!-- begin:: Content -->
    <!-- end:: Content -->
</div>

<!--End::Modal-->
@endsection
