<?php

use Request as Input; ?>
@extends('layouts.master')
@section('title','Create Department')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('user.index')}}"><h3 class="kt-subheader__title">Department</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Create Department</span>

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

                    <!--begin::Form-->
                    {!! Form::open(['route' => 'department.store','class'=>'kt-form','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    {!! Form::text('dept_name',Input::old('dept_name'), ['class' => 'form-control','id'=>"dept_name",'name'=>'dept_name','placeholder'=>'Enter Name']) !!} 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    {!! Form::textarea('dept_description',Input::old('dept_description'), ['class' => 'form-control','id'=>"dept_description",'name'=>'dept_description','placeholder'=>'Enter Descriptions']) !!} 
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions ">
                            <button type="submit" class="btn btn-primary submitbutton">Save</button>
                            <a href="{{route('department.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div> 
        </div>
    </div>

    <!-- end:: Content -->
</div>
@section('script')
<script>
    $(document).ready(function () {

        $('#createform').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50,
                },
                dept_description: {
                    required: true,
                },
            },
            submitHandler: function (form) {
                if ($("#createform").validate().checkForm()) {
                    $(".submitbutton").attr("type", "button");
                    $(".cancelbutton").addClass("disabled");
                    $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                    form.submit();
                }
            }
        });
    });
</script>
@endsection
@endsection
