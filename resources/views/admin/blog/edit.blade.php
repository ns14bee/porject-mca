<?php
use Illuminate\Support\Facades\Auth;
use Request as Input; ?>
@extends('layouts.master')
@section('title','Edit Blog')
@section('css')

@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('user.index')}}"><h3 class="kt-subheader__title">Blog</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Edit Blog</span>

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
                    {{ Form::model($data, ['route' => ['blog.update',$data->id], 'method' => 'post','id'=>'createform','name'=>'createform','class'=>'kt-form','enctype'=>'multipart/form-data']) }}                                                                                     
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    {!! Form::text('title',old('name', $data->title), ['class' => 'form-control','id'=>"title",'name'=>'title','placeholder'=>'Enter Title']) !!} 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/png,image/jpg,image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    {!! Form::textarea('description',Input::old('description'), ['class' => 'form-control','id'=>"description",'name'=>'description','placeholder'=>'Enter Descriptions']) !!} 
                                </div>
                            </div>
                            @if($data->image)
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Selected Image</label>  <br>                               
                                            <?php $full_image = App\Helpers\Helper::displayBlogimagePath().$data->image ?>
                                            <img alt="" style="width: 102px;height: 104px;" class="img-circle" src="{{$full_image}}">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions ">
                            <button type="submit" class="btn btn-primary submitbutton ">Update</button>
                            <a href="{{route('blog.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div> 
        </div>
    </div>
</div>
@section('script')
<script src="{{ url('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#createform').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 100,
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
