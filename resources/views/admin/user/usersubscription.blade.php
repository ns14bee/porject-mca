<?php use Request as Input; ?>
@extends('layouts.master')
@section('title','User Subscriptions')
@section('css')
@endsection
@section('content')


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">User Subscriptions</h3>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('errormessage')
        <div class="kt-portlet kt-portlet--mobile">

            <div class="kt-portlet__body">

                <!--begin: Datatable -->
               
                <h5>Under Constructions</h5>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

    <!-- end:: Content -->

</div>

@section('script')
<!--end::Page Vendors -->
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<!--end::Page Vendors -->

<script>
 
</script>
@endsection
@endsection
