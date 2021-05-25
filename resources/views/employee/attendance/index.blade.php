@extends('layouts.master')
@section('title','Attendance')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Attendance</h3>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <section class="content">
        <div class="container-fluid" style="padding-top: 86px;">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Today's Attendance</h3>
                        </div>
                        
                        @include('errormessage')
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if (!$attendance)
                        <form role="form" method="post" action="{{ route('attendance.store', $employee['id']) }}" >
                        @else
                        <form role="form" method="post" action="{{ route('attendance.update', $attendance['id']) }}" >
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    @if (!$attendance)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="entry_time">Entry Time</label>
                                                <input type="text" class="form-control text-center" name="entry_time"
                                                    id="entry_time" placeholder="--:--:--" disabled="">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="entry_time">Entry Time</label>
                                                <input type="text" value="{{ $attendance->entry_time }}" class="form-control text-center" name="entry_time" id="entry_time" placeholder="--:--:--" disabled style="background: #333; color:#f4f4f4" />
                                            </div>
                                        </div>
                                    @endif
                                    @if (!$registered_attendance)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exit_time">Exit Time</label>
                                                <input type="text" class="form-control text-center" name="exit_time"
                                                    id="exit_time" placeholder="--:--:--" disabled="">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exit_time">Exit Time</label>
                                                <input type="text" value="{{ $attendance->updated_at }}" class="form-control text-center" name="exit_time" id="exit_time" placeholder="--:--:--" disabled style="background: #333; color:#f4f4f4" />
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            @if (!$registered_attendance)
                            <div class="card-footer" >
                                @if (!$attendance)
                                <button type="submit" class="btn btn-primary p-3" style="font-size:1.2rem">
                                    Record Entry
                                </button>    
                                @else
                                <button type="submit" class="btn btn-primary pull-right p-3" style="font-size:1.2rem">
                                    Record Exit
                                </button>
                                @endif
                            </div>   
                            @endif

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- end:: Content -->
</div>
@endsection