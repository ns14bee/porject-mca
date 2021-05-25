@extends('layouts.master')
@section('title','Leave')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Leaves</h3>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <section class="content">
        <div class="container-fluid" style="padding-top: 20px;">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">My Leaves</h3>
                        </div>
                        
                        @include('errormessage')
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => 'leave.store','class'=>'kt-form','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="reason">Reason</label>
                                            <input type="text" class="form-control" name="reason"
                                                id="reason" placeholder="Enter Reason">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Leave</label>
                                            <select class="form-control" id="leave_type" name="leave_type">                                                
                                                <option value="haf_leave">Haf Leave</option>
                                                <option value="full_leave">Full Leave</option>
                                                <option value="multiple_leave">Multiple Leave</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="range-group">
                                            <label for="">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                            @error('start_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="range-group">
                                            <label for="">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                            @error('end_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description"
                                                id="description" placeholder="Enter Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  float-right">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary submitbutton">Save</button>
                                            <a href="{{route('leave.list')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- end:: Content -->
</div>
@section('script')
<script>
    $(document).ready(function () {

        $('#createform').validate({
            rules: {
                reason: {
                    required: true,
                    maxlength: 100,
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
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