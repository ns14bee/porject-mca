<?php
use Request as Input; ?>
@extends('layouts.master')
@section('title','Inqury Details')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('inqury.index')}}"><h3 class="kt-subheader__title">Inqury</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Inqury Details</span>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a  class="kt-widget__username">
                                            {{$data->name}}
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="mailto:{{$data->email}}"><i class="flaticon2-new-email"></i>{{$data->email}}</a>
                                        <a><i class="flaticon2-calendar-3"></i>{{ucfirst($data->status)}}</a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile3-->
            </div>
        </div>

        <!--End::Section-->

    </div>
    <!-- begin:: Content -->
    <!-- end:: Content -->
</div>


<!--begin::Modal-->
<div class="modal fade modal-part" id="kt_modal_delete_invite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this record?</p>
            </div>
            <input type="hidden" name="invite_id" id="invite_id" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn m-btn btn-danger" id="delete-invite">Delete</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->
<!--End::Modal-->
@endsection
