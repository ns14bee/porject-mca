<?php

use Request as Input;
use App\Helpers\Helper;
?>
@extends('layouts.master')
@section('title','Attendances')
@section('css')
@endsection
@section('content')


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Attendances</h3>
                
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                     @php
                        $userPer = Helper::getMenuPermission(1);
                    @endphp
                    @if(Auth::user()->role_id==config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1))
                    <a href="{{route('attendance.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Start
                    </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('errormessage')
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <br>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Entry Time</th>
                            <th>Exit Time</th>
                        </tr>
                    </thead>

                </table>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

    <!-- end:: Content -->

</div>
@include('confirmalert')
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clear Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to clear all the data ?</p>
            </div>
             <input type="hidden" name="id" id="id" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelbutton" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger submitbutton" id="clear-data">Delete</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->


@section('script')
<!--end::Page Vendors -->
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<!--end::Page Vendors -->

<script>
$(document).ready(function () {
    var initTable1 = function () {
        var table = $('#kt_table_1');

        // begin first table
        table.DataTable({
            lengthMenu: getPageLengthDatatable(),
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{route('getattendance')}}",
                type: 'post',
            },
            columns: [
                {data: 'entry_time',
                    render: function (data, type, row, meta) {
                        return moment(data).format('DD-MM-YYYY');
                    },
                    name: 'entry_time',
                    "defaultContent": "-"
                },
                {data: 'status',name: 'status'},
                {data: 'entry_time',
                    render: function (data, type, row, meta) {
                        return moment(data).format('hh:mm:ss');
                    },
                    name: 'entry_time',
                    "defaultContent": "-"
                },
                {data: 'exit_time',
                    render: function (data, type, row, meta) {
                        return moment(data).format('hh:mm:ss');
                    },
                    name: 'exit_time',
                    "defaultContent": "-"
                },
            ],
        });
    };
    initTable1();
});
</script>
@endsection
@endsection
