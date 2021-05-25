<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DaySheetController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\InquryController;
use App\Http\Controllers\admin\ApproveController;
use App\Http\Controllers\admin\ProductController;

use App\Http\Controllers\employee\AttendanceController;
use App\Http\Controllers\employee\LeaveController;
use App\Http\Controllers\FileUploadingController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('clear', function() {

    Artisan::call('cache:clear'); 
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
 
    return "Cleared!";
 
 });

// admin login start


Route::get('/', [App\Http\Controllers\front\HomeController::class, 'index'])->name('front.home');    //Homepage
Route::get('about', [App\Http\Controllers\front\HomeController::class, 'about'])->name('front.about');    //About
Route::get('contact', [App\Http\Controllers\front\HomeController::class, 'contact'])->name('front.contact');    //Contact
Route::post('contact/inqury', [App\Http\Controllers\front\HomeController::class, 'contactInqury'])->name('front.contact.inqury');    //Contact Send
Route::get('blog', [App\Http\Controllers\front\HomeController::class, 'blog'])->name('front.blog'); //Blog
Route::get('blog-detail/{id}', [App\Http\Controllers\front\HomeController::class, 'blog_single'])->name('front.blog_single'); //Blog-single
Route::get('product', [App\Http\Controllers\front\HomeController::class, 'product'])->name('front.product'); //Products
Route::Post('product-mail/{id}', [App\Http\Controllers\front\HomeController::class, 'productMail'])->name('front.product.mail'); //Products Send Mail
Route::get('thankyou', [App\Http\Controllers\front\HomeController::class, 'thankyou'])->name('front.thankyou'); //Thank you

Auth::routes();

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('home');
Route::get('home', [App\Http\Controllers\Auth\LoginController::class, 'index']);


Route::get('forgot-password/{token}/{ismobile?}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showPasswordResetForm'])->name('resetpasswordform');
Route::post('resetpasswordemail', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPasswordSendEmail'])->name('resetpasswordemail');
Route::post('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('passwordreset');


Route::get('registration-confirmation/{token}', [App\Http\Controllers\Auth\LoginController::class, 'confirmation']);
Route::get('verification', [App\Http\Controllers\Auth\LoginController::class, 'verification'])->name('verification');

Route::get('404notfound', [App\Http\Controllers\admin\HomeController::class, 'notFound'])->name('404notfound');
Route::get('500error', [App\Http\Controllers\admin\HomeController::class, 'exceptions'])->name('500error');
Route::get('401unauthorized', [App\Http\Controllers\admin\HomeController::class, 'unauthorized'])->name('401unauthorized');

Route::middleware(['auth'])->group(function (){
    
    /* Admin */
    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    // if(Auth::user()->role_id==config('const.roleAdmin')){
        Route::group(['prefix' => 'admin','namespace' => 'admin'], function() {
            
            Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
            
            /* My profile */
            Route::get('myprofile', [UserController::class, 'myProfile'])->name('myprofile');        
            Route::post('updatemyprofile', [UserController::class, 'updateMyProfile'])->name('updatemyprofile');
            
            /* Change Password */        
            Route::get('change-password', [UserController::class, 'chnagePassword'])->name('change-password');        
            Route::post('change-password', [UserController::class, 'storeChangePassword'])->name('change.password');
            
            /* User Section */        
            Route::get('employee/index', [UserController::class, 'index'])->name('user.index');
            Route::get('employee/create', [UserController::class, 'create'])->name('user.create');
            Route::post('employee/store', [UserController::class, 'store'])->name('user.store');
            Route::get('employee/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::patch('employee/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('employee/{id}', [UserController::class, 'show'])->name('user.show');
            Route::delete('employee/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');        
            
            Route::post('getusers', [UserController::class, 'postUsersList'])->name('getusers'); 
            Route::post('userresetpassword', [UserController::class, 'postResetUserPassword'])->name('userresetpassword'); 


            /* Department Section */        
            Route::get('department/index', [DepartmentController::class, 'index'])->name('department.index');
            Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
            Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
            Route::get('department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
            Route::patch('department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
            Route::get('department/{id}', [DepartmentController::class, 'show'])->name('department.show');
            Route::delete('department/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');        
            
            Route::post('getdepartments', [DepartmentController::class, 'postDepartmentsList'])->name('getdepartments'); 

            /* Day Sheet */
            Route::get('daysheet/index', [DaySheetController::class, 'index'])->name('daysheet.index');
            Route::post('getdaysheets', [DaySheetController::class, 'postDaySheetsList'])->name('getdaysheets'); 

            /* Blog Section */        
            Route::get('blog/index', [BlogController::class, 'index'])->name('blog.index');
            Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
            Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
            Route::post('blog/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::get('blog/list', [BlogController::class, 'list'])->name('blog.list');
            Route::post('blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');        
            
            Route::post('getblog', [BlogController::class, 'postblogList'])->name('getblog'); 

            /* Product Section */        
            Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
            Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('product', [ProductController::class, 'store'])->name('product.store');
            Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('product/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('product/list', [ProductController::class, 'list'])->name('product.list');
            Route::post('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete'); 
            Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');

            Route::post('getproduct', [ProductController::class, 'postProductList'])->name('getproduct'); 

            /* Inqury Section */        
            Route::get('inqury/index', [InquryController::class, 'index'])->name('inqury.index');
            Route::get('inqury/create', [InquryController::class, 'create'])->name('inqury.create');
            Route::post('inqury', [InquryController::class, 'store'])->name('inqury.store');
            Route::put('inqury/{id}', [InquryController::class, 'update'])->name('inqury.update');
            Route::get('inqury/list', [InquryController::class, 'list'])->name('inqury.list');
            Route::post('inqury/delete/{id}', [InquryController::class, 'destroy'])->name('inqury.delete');        
            
            Route::post('getinqury', [InquryController::class, 'postInquryList'])->name('getinqury'); 
            
             
            /* Attendance Section */        
            Route::get('attendance/index', [AttendanceController::class, 'index'])->name('attendance.index');
            Route::get('attendance/list', [AttendanceController::class, 'list'])->name('attendance.list');
            Route::post('attendance/{employee_id}', [AttendanceController::class, 'store'])->name('attendance.store');
            Route::put('attendance/{attendance_id}', [AttendanceController::class, 'update'])->name('attendance.update');
            
            Route::post('getattendance', [AttendanceController::class, 'postAttendanceList'])->name('getattendance'); 
            
            /* Leave Section */

            Route::get('leave/index', [LeaveController::class, 'index'])->name('leave.index');
            Route::get('leave/list', [LeaveController::class, 'list'])->name('leave.list');
            Route::post('leave/store', [LeaveController::class, 'store'])->name('leave.store');
            Route::post('leave/delete/{id}', [LeaveController::class, 'destroy'])->name('leave.delete'); 

            Route::post('getleave', [LeaveController::class, 'postLeaveList'])->name('getleave'); 

            /* Approve Section */
            Route::get('approve/index', [ApproveController::class, 'index'])->name('approve.index');
            Route::post('getapprove', [ApproveController::class, 'postApproveList'])->name('getapprove');
            Route::post('leave/approve/{id}', [ApproveController::class, 'approveLeave'])->name('leaveapprove.delete'); 
            Route::post('leave/reject/{id}', [ApproveController::class, 'rejectLeave'])->name('leavereject.delete'); 

            /* File Uploading Section */

            Route::get('fileuploading/index', [FileUploadingController::class, 'index'])->name('fileuploading.index');
            Route::get('fileuploading/create', [FileUploadingController::class, 'create'])->name('fileuploading.create');
            Route::post('fileuploading/store', [FileUploadingController::class, 'store'])->name('fileuploading.store');
            Route::get('fileuploading/list', [FileUploadingController::class, 'list'])->name('fileuploading.list');
            
            Route::post('fileuploading/delete/{id}', [FileUploadingController::class, 'destroy'])->name('fileuploading.delete');  
            Route::post('getfileuploading', [FileUploadingController::class, 'postfileuploadingList'])->name('getfileuploading');    
            
        });
    // }

    
    // if(Auth::user()->role_id==config('const.roleEmployee')){
        // Route::group(['prefix' => 'employee','namespace' => 'employee'], function() {
            
        //     Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
            
        //     /* My profile */
        //     Route::get('myprofile', [UserController::class, 'myProfile'])->name('myprofile');        
        //     Route::post('updatemyprofile', [UserController::class, 'updateMyProfile'])->name('updatemyprofile');
            
        //     /* Change Password */        
        //     Route::get('change-password', [UserController::class, 'chnagePassword'])->name('change-password');        
        //     Route::post('change-password', [UserController::class, 'storeChangePassword'])->name('change.password');
        // });
    // }
    
});  