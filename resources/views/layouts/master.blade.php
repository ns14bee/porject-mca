<?php 
use App\Helpers\Helper;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@lang('messages.siteName') - @yield('title')</title>

        <!-- Scripts -->
        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
        <!--end::Fonts -->

        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="{{ url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles -->

        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles -->
                
        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles -->

        <link href="{{url('assets/developer/developer.css')}}" rel="stylesheet" type="text/css" />
        @yield('css')
        <!-- Styles -->
        <link rel="shortcut icon" href="{{url('assets/media/logos/fav.png')}}" /> 
    </head>

    <!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

        <!-- begin:: Page -->

        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="{{route('dashboard')}}">
                    <img alt="Logo" src="{{ url('assets/media/logos/logo.png') }}" />
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>

        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

                <!-- begin:: Aside -->
                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                    <!-- begin:: Aside -->
                    <div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
                        <div class="kt-aside__brand-logo">
                            <a href="{{route('dashboard')}}">
                                <!-- <img alt="Logo" src="{{ url('assets/media/logos/logo.png') }}" /> -->
                                <!-- <img src="{{ url('assets/media/icons/admin_logo.png') }}"> -->
                                <h2>AWMS</h2>
                            </a>
                        </div>
                    </div>

                    <!-- end:: Aside -->

                    <!-- begin:: Aside Menu -->
                    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                        <div style="margin-top: -20px;" id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown" data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
                            <ul class="kt-menu__nav ">
                                <li class="kt-menu__item  {{ Route::is('dashboard') || Route::is('fileuploading.index')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('dashboard')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-dashboard"></i><span class="kt-menu__link-text">Dashboard</span></a></li>
                                @php
                                    $userPer = Helper::getMenuPermission(1);
                                @endphp
                                @if(Auth::user()->role_id==config('const.roleAdmin'))
                                <li class="kt-menu__item  {{ Route::is('department.show') || Route::is('department.index') || Route::is('department.create')  || Route::is('department.edit')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('department.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-bars"></i><span class="kt-menu__link-text">Department</span></a></li>
                                <li class="kt-menu__item  {{ Route::is('user.show') || Route::is('user.index') || Route::is('user.create')  || Route::is('user.edit')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('user.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-user"></i><span class="kt-menu__link-text">Employee</span></a></li>
                                <li class="kt-menu__item  {{ Route::is('daysheet.index') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('daysheet.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-calendar"></i><span class="kt-menu__link-text">Day Sheet</span></a></li>
                                <li class="kt-menu__item  {{ Route::is('product.show') || Route::is('product.index') || Route::is('product.create')  || Route::is('product.edit')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('product.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-cubes"></i><span class="kt-menu__link-text">Product</span></a></li>
                                <li class="kt-menu__item  {{ Route::is('blog.show') || Route::is('blog.index') || Route::is('blog.create')  || Route::is('blog.edit')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('blog.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-th-large"></i><span class="kt-menu__link-text">Blog</span></a></li>
                                <li class="kt-menu__item  {{ Route::is('inqury.show') || Route::is('inqury.index')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('inqury.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-question-circle"></i><span class="kt-menu__link-text">Inquiry</span></a></li>
                                @endif
                                @if(Auth::user()->role_id==config('const.roleEmployee'))
                                <li class="kt-menu__item  {{ Route::is('attendance.index') || Route::is('attendance.list')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('attendance.list')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-calendar"></i><span class="kt-menu__link-text">Attendance</span></a></li>
                                <li class="kt-menu__item  {{ Route::is('leave.index') || Route::is('leave.list')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('leave.list')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-address-card"></i><span class="kt-menu__link-text">Leaves</span></a></li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>

                    <!-- end:: Aside Menu -->
                </div>

                <!-- end:: Aside -->
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    <!-- begin:: Header -->
                    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                        <!-- begin: Header Menu -->
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
                                <ul class="kt-menu__nav ">
                                    @if(Route::is('dashboard') || Route::is('fileuploading.index') || Route::is('fileuploading.create') || Route::is('fileuploading.edit') || Route::is('approve.index'))
                                        @if(Auth::user()->role_id==config('const.roleAdmin')  ||  Auth::user()->role_id==config('const.roleEmployee'))
                                            <li class="kt-menu__item  {{ Route::is('dashboard')  ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('dashboard')}}" class="kt-menu__link "><span class="kt-menu__link-text">Dashboard</span></a></li>
                                            <li class="kt-menu__item  {{  Route::is('fileuploading.index') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('fileuploading.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">File Uploading</span></a></li>
                                        @endif
                                        @if (Auth::user()->role_id==config('const.roleAdmin'))                                       
                                            <li class="kt-menu__item  {{  Route::is('approve.index') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('approve.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">Approve Leave</span></a></li>
                                        @endif    
                                   @endif                                    
                                </ul>
                            </div>
                        </div>

                        <!-- end: Header Menu -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">

                            

                            <!--begin: Notifications -->
                            
                            <!--end: Notifications -->

                            <!--begin: Quick Actions -->
                            
                            <!--end: Quick Actions -->

                            <!--begin: Cart -->
                            <div class="kt-header__topbar-item dropdown">
                               
                            </div>

                            <!--end: Cart-->

                            <!--begin: Quick panel -->
                            
                            <!--end: Quick panel -->

                            <!--begin: Language bar -->
                            <!--end: Language bar -->

                            <!--begin: User Bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                                    <div class="kt-header__topbar-user">
                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder">{{ucfirst(substr(Auth::user()->name, 0, 1))}}</span>
                                    </div>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                                    <!--begin: Head -->
                                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-color: #8e8eed;">
                                        <div class="kt-user-card__avatar">
                                            <img class="kt-hidden" alt="Pic" src="{{ url('assets/media/users/300_25.jpg')}}" />

                                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ucfirst(substr(Auth::user()->name, 0, 1))}}</span>
                                        </div>
                                        <div class="kt-user-card__name">
                                            {{ucfirst(Auth::user()->name)}}
                                        </div>
<!--                                        <div class="kt-user-card__badge">
                                            <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                                        </div>-->
                                    </div>

                                    <!--end: Head -->

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <a href="{{route('myprofile')}}" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    My Profile
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Change Password and more
                                                </div>
                                            </div>
                                        </a>
                                       
                                        <div class="kt-notification__custom kt-space-between">
                                            <a href="{{route('logout')}}"  class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                        </div>
                                    </div>

                                    <!--end: Navigation -->
                                </div>
                            </div>

                            <!--end: User Bar -->
                        </div>

                        <!-- end:: Header Topbar -->
                    </div>

                    <!-- end:: Header -->
                    @yield('content')

                    <!-- begin:: Footer -->
                    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-footer__copyright">
                                {{ now()->year }} &copy;<a href="#" target="_blank" class="kt-link">@lang('messages.footer')</a>
                            </div>
                        </div>
                    </div>

                    <!-- end:: Footer -->
                </div>
            </div>
        </div>

        <!-- end:: Page -->

        <!-- begin::Quick Panel -->
      
        <!-- end::Quick Panel -->

        <!--Begin:: Chat-->
        

        <!--ENd:: Chat-->
    </body>
    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
       var KTAppOptions = {
                "colors": {
                        "state": {
                                "brand": "#2c77f4",
                                "light": "#ffffff",
                                "dark": "#282a3c",
                                "primary": "#5867dd",
                                "success": "#34bfa3",
                                "info": "#36a3f7",
                                "warning": "#ffb822",
                                "danger": "#fd3995"
                        },
                        "base": {
                                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                        }
                }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ url('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ url('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
    
    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ url('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>
    <!--end::Page Scripts -->
    
    <!-- end::Body -->
    <script src="{{url('assets/developer/developer.js')}}" type="text/javascript"></script>
    <script type="text/javascript">window.baseUrl = "@php echo URL::to('/'); @endphp"</script>
    <script>window.siteName="@php echo trans('messages.siteName'); @endphp"</script>
    
    <!-- Central Timexzone Management -->
        <script src="https://momentjs.com/downloads/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.26/moment-timezone-with-data-10-year-range.js"></script>
        <script>
            var tz = moment.tz.guess();
            document.cookie = "headvalue="+tz;
            $(document).ready(function() {
                 
                $.ajax({
                    url: baseUrl+'/settimezone',
                    type: "POST",
                    dataType: 'json',
                    data: {timezone:tz},
                    success: function (data) {
                        
                    },
                    error: function (data) {
                        
                    }
                });
            });
        </script>
    <!-- Time Xone manage End -->
    @yield('script')
</html>
