<?php

use Request as Input;
use App\Helpers\Helper;
?>
@extends('layouts.master')
@section('title','File Uploading')
@section('css')
@endsection
@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">File Uploading</h3>                
            </div>
        </div>
    </div>    
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                @include('errormessage')
        <div class="row">
            <div class="col-md-4">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <!--begin::Form-->
                    {!! Form::open(['route' => 'fileuploading.store','class'=>'kt-form','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    {!! Form::text('title',Input::old('title'), ['class' => 'form-control','id'=>"title",'name'=>'title','placeholder'=>'Enter Title']) !!} 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>File Uploading</label>
                                    <input type="file" class="form-control" id="file_upload" name="file_upload">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions ">
                            <button type="submit" class="btn btn-primary submitbutton">Save</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div> 
            <div class="col-md-8">
                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__body">
                                <br>
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                    <thead>
                                        <tr>
                                            <th width="140.5px">Title</th>
                                            <th>File Downloading</th>
                                            <th width="100.5px">Created At</th>
                                            <th width="100.5px">Actions</th>
                                        </tr>
                                    </thead>

                                </table>

                                <!--end: Datatable -->
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
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
                responsive: true,
                searchDelay: 500,
                aLengthMenu: [[3, 5, 10, -1], [3, 5, 10, "All"]],
                pageLength: 3,
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: "{{route('getfileuploading')}}",
                    type: 'post',
                    data: function (data) {
                        data.fromValues = $("#filterData").serialize();
                    }
                },
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'file_upload', 
                        render: function (data, type, full, meta) {
                            return '<a href=\"'  + data + '\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" download> <i class=\"fa fa-download\"></i></a>';
                        }, searchable: false, sortable: false
                    }, 
                    {data: 'created_at', name: 'file_uploading.created_at',
                        render: function (data, type, row, meta) {
                            var dateWithTimezone = moment.utc(data).tz(tz);
                            return dateWithTimezone.format('<?php echo config('const.JSdisplayDateTimeFormatWithAMPM'); ?>');
                        }
                    },
                    {data: 'action', name: 'action', searchable: false, sortable: false,responsivePriority: -1},
                ],
            });
        };
        initTable1();

        $('#createform').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 50,
                },
                file_upload: {
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

        $("#delete-record").on("click", function () {
            var id = $("#id").val();
            $('#kt_modal_1').modal('hide');
            $.ajax({
                url: baseUrl + '/admin/fileuploading/delete/' + id,
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
