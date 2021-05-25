<?php

use Request as Input;
use App\Helpers\Helper;
?>
@extends('layouts.master')
@section('title','Approve Leave')
@section('css')
@endsection
@section('content')


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Approve Leave</h3>
                
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <br>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th width="90.5px">Applied on</th>
                            <th width="55.5px">Name</th>
                            <th width="65.5px">Reason</th>
                            <th width="75.5px">Leave Type</th>
                            <th>Status</th>
                            <th width="65.5px">Start Date</th>
                            <th width="65.5px">End Date</th>
                            <th>Description</th>
                            <th width="200.5px">Approve / Reject Permission</th>
                        </tr>
                    </thead>

                </table>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

    <!-- end:: Content -->

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to Approve request ?</p>
            </div>
             <input type="hidden" name="id" id="approve_get_id" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelbutton" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger submitbutton" id="approve_id">Approve</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to Reject request ?</p>
            </div>
             <input type="hidden" name="id" id="reject_get_id" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelbutton" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger submitbutton" id="reject_id">Reject</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->

</div>
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
                url: "{{route('getapprove')}}",
                type: 'post',
                data: function (data) {
                    data.fromValues = $("#filterData").serialize();
                }
            },
            columns: [
                {data: 'created_at', name: 'leaves.created_at',
                    render: function (data, type, row, meta) {
                        var dateWithTimezone = moment.utc(data).tz(tz);
                        return dateWithTimezone.format('<?php echo config('const.JSdisplayDateTimeFormatWithAMPM'); ?>');
                    }
                },
                {data: 'user_name', name: 'user_name'},
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
                {data: 'permission', name: 'permission', searchable: false, sortable: false,responsivePriority: -1},
            ],
        });
    };
    initTable1();


    $("#approve_id").on("click", function () {
        var id = $("#approve_get_id").val();
        $('#kt_modal_1').modal('hide');
        $.ajax({
            url: baseUrl + '/admin/leave/approve/' + id,
            type: "post",
            dataType: 'json',
            success: function (data) {
                if (data == 'Error') {
                    toastr.error("Oops, There is some thing went wrong.Please try after some time.");
                } else {
                    toastr.success('@lang('messages.approveDelete')', '@lang('messages.success')');
                            $('#kt_table_1').DataTable().clear().destroy();
                    initTable1();
                }
            },
            error: function (data) {
                toastr.error("@lang('messages.oopserror')", "@lang('messages.error')");
            }
        });
    });

    $("#reject_id").on("click", function () {
        var id = $("#reject_get_id").val();
        $('#kt_modal_1').modal('hide');
        $.ajax({
            url: baseUrl + '/admin/leave/reject/' + id,
            type: "post",
            dataType: 'json',
            success: function (data) {
                if (data == 'Error') {
                    toastr.error("Oops, There is some thing went wrong.Please try after some time.");
                } else {
                    toastr.success('@lang('messages.rejectDelete')', '@lang('messages.success')');
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
