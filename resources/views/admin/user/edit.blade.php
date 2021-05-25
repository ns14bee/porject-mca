<?php
use Illuminate\Support\Facades\Auth;
use Request as Input; ?>
@extends('layouts.master')
@section('title','Edit Employee')
@section('css')

@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('user.index')}}"><h3 class="kt-subheader__title">Employee</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Edit Employee</span>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                @include('errormessage')
                <div class="kt-portlet">
<!--                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit User
                            </h3>
                        </div>
                    </div>-->

                    <!--begin::Form-->
                    {{ Form::model($data, ['route' => ['user.update',$data->id], 'method' => 'patch','id'=>'createform','name'=>'createform','class'=>'kt-form','enctype'=>'multipart/form-data']) }}                                                                                     
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    {!! Form::text('name',old('name', $data->name), ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Enter Name']) !!} 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('email',old('email', $data->email), ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'Enter Email']) !!} 
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role_id" name="role_id">
                                        @foreach($roles as $roles)
                                        @if($roles->id !=config('const.roleSuperAdmin'))
                                            
                                                <option value="{{ $roles->id }}" <?php if ($data->role_id == $roles->id) {
                                                    echo "selected";
                                                } ?>>{{ $roles->name }}</option>
                                           
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        @foreach($statusArray as $key=>$statusArray)
                                            <option value="{{ $key }}" <?php
                                            if ($data->status == $key) {
                                                echo "selected";
                                            }
                                            ?>>{{ $statusArray }}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" id="department_id" name="department_id">
                                        @foreach($department as $key=>$departments)
                                            <option value="{{ $key }}" <?php
                                            if ($data->department_id == $key) {
                                                echo "selected";
                                            }
                                            ?>>{{ $departments }}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="invited_user_permission"  style="display:none;" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Invited User Permission</label>
                                    <br>
                                    <div class="checkbox-list">
                                        <label class="checkbox" style="cursor: pointer;">
                                            <input type="radio" value="read" name="permissions" style="cursor: pointer;" <?php 
                                            if(isset($data->permission) && $data->permission=='read'){
                                                echo "checked";
                                            }
                                            ?> > Read
                                            <span></span>
                                        </label>&nbsp;&nbsp;
                                        <label class="checkbox" name="permissions" style="cursor: pointer;" <?php if(isset($userdata->permission) && $userdata->permission=='write') echo "checked"; ?>>
                                            <input type="radio" value="write" name="permissions" style="cursor: pointer;" <?php 
                                            if(isset($data->permission) && $data->permission=='write'){
                                                echo "checked";
                                            }?> > Write
                                            <span></span>
                                        </label>&nbsp;&nbsp;
<!--                                        <label class="checkbox" style="cursor: pointer;" <?php if(isset($userdata->permission) && $userdata->permission=='master') echo "checked"; ?>>
                                            <input type="radio" value="master" name="permissions" style="cursor: pointer;" <?php 
                                            if(isset($data->permission) && $data->permission=='master'){
                                                echo "checked";
                                            }?> >  Master
                                            <span></span>-->
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>    


                    </div>
                    
                    
                    <div class="col-md-6" id="role_permission">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Menu Permissions
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin::Section-->
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Menu Name</th>
                                                <th>Read</th>
                                                <th>Write</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($menus as $menusData)
                                                <tr>
                                                    <td>{{$menusData->name}}</td>
                                                    <td>
                                                        <input type="checkbox" data-id="{{ $menusData->id }}"  class="custom_permission_checkbox read" id="read_{{ $menusData->id }}_read" name="read[{{ $menusData->id }}][read]"  <?php echo $menusData->is_read; ?> />    
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" data-id="{{ $menusData->id }}" class="custom_permission_checkbox read" id="write_{{ $menusData->id }}_read" name="write[{{ $menusData->id }}][write]" <?php echo $menusData->is_write; ?>/>
                                                    </td>
                                                </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!--end::Section-->

                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions ">
                            <button type="submit" class="btn btn-primary submitbutton ">Update</button>
                            <a href="{{route('user.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div> 
        </div>
    </div>
    @if($data->role_id==config('const.roleUserMaster'))
       
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
             
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Edit Deceased Details
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        @if($deceaseData)
                        {{ Form::model($deceaseData, ['route' => ['decease.update',$deceaseData->id], 'method' => 'post','id'=>'deceaseform','name'=>'deceaseform','class'=>'kt-form','enctype'=>'multipart/form-data']) }}                                                                                     
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        {!! Form::text('name',Input::old('name'), ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Enter Name']) !!} 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        {!! Form::textarea('address',Input::old('address'), ['class' => 'form-control','id'=>'address','rows'=>2,'placeholder'=>'Enter Address']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date Of Passing</label>
                                        <div class="input-group date ">
                                            <input type="text" name="date_of_passing" class="form-control date_of_passing" data-date-format="<?php echo config('const.displayDateBlade'); ?>"  placeholder="Select date" id="kt_datepicker_2" value="{{$deceaseData->date_of_passing}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <div class="input-group date ">
                                            <input type="text" name="birth_date" class="form-control birth_date" data-date-format="<?php echo config('const.displayDateBlade'); ?>" readonly="" placeholder="Select date" id="kt_datepicker_1" value="{{$deceaseData->birth_date}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Location</label>
                                        {!! Form::textarea('birth_location',Input::old('birth_location'), ['class' => 'form-control','id'=>'birth_location','rows'=>2,'placeholder'=>'Enter Birth Location']) !!}
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions ">
                                <button type="submit" class="btn btn-primary submitbutton-decease submitbutton">Update</button>
                                <a href="{{route('user.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                            </div>
                        </div>

                        {!! Form::close() !!}
                        <!--end::Form-->
                        @else
                        <br/>
            &nbsp;&nbsp;&nbsp;{{trans('messages.noDeceaseDeatils')}}<br/>
            <br/>
        @endif
                    </div>

                    <!--end::Portlet-->
                </div> 
            </div>
             
        </div>
        
    @endif    
    <!-- end:: Content -->
    
 
</div>
@section('script')
<script src="{{ url('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        
        /* Invited User Permission */
        <?php if($data->parent_user_id!=''){ ?>
                 $("#invited_user_permission").css("display", "block");
        <?php } ?>   
            
        
        
        $('.datepicker').datetimepicker({
             format: 'DD-MM-YYYY'
        });
        
        <?php if($data->role_id==config('const.roleSuperAdmin') || $data->role_id==config('const.roleUserMaster') || $data->role_id==config('const.roleUserInvited')){ ?>
                $("#role_permission").css("display", "none");
        <?php } ?>
        
        $( "#role_id" ).change(function() {
            
            if($( "#role_id" ).val() !=1 && $( "#role_id" ).val() !=5 && $( "#role_id" ).val() !=6){
                $("#role_permission").css("display", "block");   
            }else{
                $("#role_permission").css("display", "none");
            }
            
            if($( "#role_id" ).val() ==6){
                <?php if($data->parent_user_id !=''){ ?>
                     $("#invited_user_permission").css("display", "block");
                <?php }else{ ?>
                    $("#invited_user_permission").css("display", "none");
                <?php } ?>    
            }else{
                $("#invited_user_permission").css("display", "none");
            }
        });


        $('#createform').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50,
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true
                }
            },
            submitHandler: function (form) {
                if ($("#createform").validate().checkForm()) {
                    $(".submitbutton").attr("type", "button");
                    $(".submitbutton").addClass("disabled");
                    $(".cancelbutton").addClass("disabled");
                    $(".submitbutton").addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                    form.submit();
                }
            }
        });
        
        $('#deceaseform').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50,
                },
//                address: {
//                    required: true,
//                },
                birth_location: {
                    required: true,
                },
                
            },
            submitHandler: function (form) {
                if ($("#deceaseform").validate().checkForm()) {
                    $(".submitbutton").attr("type", "button");
                    $(".submitbutton").addClass("disabled");
                    $(".cancelbutton").addClass("disabled");
                    $(".submitbutton-decease").addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                    form.submit();
                }
            }
        });
        
        $( "#kt_datepicker_2" ).datepicker('setEndDate', new Date());
        $( ".birth_date" ).datepicker('setEndDate', new Date());
        
        
    });
</script>
@endsection
@endsection
