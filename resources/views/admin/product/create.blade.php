<?php

use Request as Input; ?>
@extends('layouts.master')
@section('title','Create Product')
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
                <span class="kt-subheader__desc">Create Product</span>

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
                    {!! Form::open(['route' => 'product.store','class'=>'kt-form','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                        @include('admin.product.common')
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
                },
                image: {
                    required: true,
                    accept: "image/*",
                },
                description: {
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
