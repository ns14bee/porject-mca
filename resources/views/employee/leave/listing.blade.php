<?php

use Request as Input;
use App\Helpers\Helper;
?>
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
                <h3 class="kt-subheader__title">Leave</h3>
                
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                     @php
                        $userPer = Helper::getMenuPermission(1);
                    @endphp
                    @if(Auth::user()->role_id==config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1))
                    <a href="{{route('leave.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Apply
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
                            <th>Applied on</th>
                            <th>Reason</th>
                            <th>Leave Type</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th width="300.5px">Description</th>
                            <td>Actions</td>
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
                url: "{{route('getleave')}}",
                type: 'post',
            },
            columns: [
                {data: 'created_at', name: 'leaves.created_at',
                    render: function (data, type, row, meta) {
                        var dateWithTimezone = moment.utc(data).tz(tz);
                        return dateWithTimezone.format('<?php echo config('const.JSdisplayDateTimeFormatWithAMPM'); ?>');
                    }
                },
                {data: 'reason', name: 'reason'},
                {data: 'leave_type', name: 'leave_type'},
                {data: 'status', name: 'status'},
                {data: 'start_date', name: 'leaves.start_date',
                    render: function (data, type, row, meta) {
                        var dateWithTimezone = moment.utc(data).tz(tz);
                        return dateWithTimezone.format('<?php echo config('const.JSdisplayDateTimeFormatWithTPTP'); ?>');
                    }
                },
                {data: 'end_date', name: 'leaves.end_date',
                    render: function (data, type, row, meta) {
                        var dateWithTimezone = moment.utc(data).tz(tz);
                        return dateWithTimezone.format('<?php echo config('const.JSdisplayDateTimeFormatWithTPTP'); ?>');
                    }
                },
                {data: 'description', name: 'description'},                
                {data: 'action', name: 'action', searchable: false, sortable: false,responsivePriority: -1},
            ],
        });
    };
    initTable1();

    $("#delete-record").on("click", function () {
        var id = $("#id").val();
        $('#kt_modal_1').modal('hide');
        $.ajax({
            url: baseUrl + '/admin/leave/delete/' + id,
            type: "post",
            dataType: 'json',
            success: function (data) {
                if (data == 'Error') {
                    toastr.error("Oops, There is some thing went wrong.Please try after some time.");
                } else {
                    toastr.success('@lang('messages.recordDelete')', '@lang('messages.success')');
                            $('#kt_table_1').DataTable().clear().destroy();
                    initTable1();
                }
            },
            error: function (data) {
                toastr.error("@lang('messages.oopserror')", "@lang('messages.error')");
            }
        });
    });
});
</script>
@endsection
@endsection