<?php

namespace App\Helpers;
use App\Models\MenuPermission;
use Request;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use URL;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator; 

class Helper {

    public static function res($data, $msg, $code) {
        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'msg' => $msg,
            'version' => '1.0.0',
            'data' => $data
        ];
        return response()->json($response, $code);
    }

    public static function success($data = [], $msg = 'Success', $code = 200) {
        return Helper::res($data, $msg, $code);
    }

    public static function fail($data = [], $msg = "Some thing wen't wrong!", $code = 203) {
        return Helper::res($data, $msg, $code);
    }

    public static function error_parse($msg) {
        foreach ($msg->toArray() as $key => $value) {
            foreach ($value as $ekey => $evalue) {
                return $evalue;
            }
        }
    }

    public static function active($param = "") {
        return Request::path() == $param ? 'active open' : '';
    }

    public static function AttendanceStatus($data) {
        if ($data->status == config('const.statusPresent')) {
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Present</span>';
        }else if($data->status == config('const.statusHalf_Day')){
            return '<span class="kt-badge  kt-badge--yellow kt-badge--inline kt-badge--pill " style="color: #ffffff;
                    background: #ffb822 !important;">Half Day</span>';
        }else if($data->status == config('const.statusAbsent')){
            return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Absent</span>';
        }else if($data->status == config('const.statusSunday')){
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Sunday</span>';
        } else if($data->status == config('const.statusLeave')){
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Leave</span>';
        } else if($data->status == config('const.statusHoliday')){
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Holiday</span>';
        } else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }


    public static function LeaveStatus($data) {
        if ($data->status == config('const.Approve')) {
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approve</span>';
        }else if($data->status == config('const.Pending')){
            return '<span class="kt-badge  kt-badge--yellow kt-badge--inline kt-badge--pill " style="color: #ffffff;
                    background: #ffb822 !important;">Pending</span>';
        }else if($data->status == config('const.Reject')){
            return '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Reject</span>';
        }else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }

    public static function LeaveType($data) {
        if ($data->leave_type == config('const.HafLeave')) {
            return '<span class="kt-badge  kt-badge--yellow kt-badge--inline kt-badge--pill"  style="color: #ffffff;
            background: #a8a6a2 !important;">Haf Leave</span>';
        }else if($data->leave_type == config('const.FullLeave')){
            return '<span class="kt-badge  kt-badge--yellow kt-badge--inline kt-badge--pill " style="color: #ffffff;
                    background: #a8a6a2 !important;">Full Leave</span>';
        }else if($data->leave_type == config('const.MultipleLeave')){
            return '<span class="kt-badge kt-badge--yellow kt-badge--inline kt-badge--pill"  style="color: #ffffff;
            background: #a8a6a2 !important;">Mutiple Leave</span>';
        }else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }

   
   
    public static function Status($data) {
        if ($data->status == config('const.statusActive')) {
            return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span>';
        }else if($data->status == config('const.statusInActive')){
            return '<span class="kt-badge  kt-badge--yellow kt-badge--inline kt-badge--pill " style="color: #ffffff;
                    background: #ffb822 !important;">InActive</span>';
        }else if($data->status == config('const.statusPending')){
            return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Pending</span>';
        }else if($data->status == config('const.statusLocked')){
            return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Locked</span>';
        } else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
        }
    }
    
    public static function viewQrCode($code){
        return '<a data-toggle="modal" data-target="#exampleModal2" qrcode="'.$code.'"  class="btn btn-xs yellow viewqrcode"><i class="fa fa-eye"></i></a>';
    }

    
    public static function Action($editLink = '', $deleteID = '', $viewLink = '',$recoverylink='') {
        if ($editLink)
            $edit = '<a href="' . $editLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"> <i class="la la-edit"></i></a>';
        else
            $edit = '';

        if ($deleteID)
            $delete = '<a onclick="deleteValueSet(' . $deleteID . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-toggle="modal" data-target="#kt_modal_1" >  <i class="la la-trash"></i></a>';
        else
            $delete = '';

        if ($viewLink)
            $view = '<a href="' . $viewLink . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
        else
            $view = '';
        
        if ($recoverylink)
            $recovery = '<a onclick="deleteValueSet(' . $deleteID . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-toggle="modal" data-target="#kt_modal_2" >  <i class="la la-eraser"></i></a>';
        else
            $recovery = '';
        
        return $view . '' . $edit . '' . $delete . '' .$recovery .'';
    }


    public static function LeaveAction($approveLink = '', $rejectLink = '') {
        if ($approveLink)
            $approve = '<a onclick="approveValueSet(' . $approveLink . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#kt_modal_3">  <i class="fa fa-check"></i></a>';
        else
            $approve = '';

        if ($rejectLink)
            $reject = '<a onclick="rejectValueSet(' . $rejectLink . ')"  class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" data-target="#kt_modal_4">  <i class="fa fa-times"></i></a>';
        else
            $reject = '';
        
        return $reject . '' . $approve . '';
    }
    
     public static function type($type) {
        if($type=='content'){
            return "Content";
        }
        if($type=='url'){
            return "URL";
        }
        if($type=='video_url'){
            return "Video URL";
        }
        if($type=='video_file'){
            return "Video File";
        }
        if($type=='pdf'){
            return "PDF";
        }
    }
    
    
    /* For Store Path Start */
    public static function profileFileUploadPath(){
       return storage_path('app/public/profilepic/');
    }
    public static function bugAttachmentFileUploadPath(){
       return storage_path('app/public/bugsfile/');
    }
    public static function supportAttachmentFileUploadPath(){
	return storage_path('app/public/supportsfile/');
    }
    public static function partnerLogoFileUploadPath(){
	return storage_path('app/public/logo/');
    }
    public static function cmsFileUploadPath(){
	return storage_path('app/public/cms/');
    }
    public static function BlogimageFileUploadPath(){
        return storage_path('app/public/blog/');
    }
    public static function DataFileUploadPath(){
        return storage_path('app/public/files/');
    }
    public static function DataProductUploadPath(){
        return storage_path('app/public/product/');
    }
    
    /* For Store Path End */
    
    /* For Display Image */
    public static function displayProfilePath(){
        return URL::to('/').'/storage/profilepic/';
    }
    public static function displayBugAttachmentPath(){
        return URL::to('/').'/storage/bugsfile/';
    }
    public static function displaySupportAttachmentPath(){
	return URL::to('/').'/storage/supportsfile/';
    }
    public static function displayPartnerLogoPath(){
	return URL::to('/').'/storage/logo/';
    }
    public static function displayCmsFilePath(){
	return URL::to('/').'/storage/cms/';
    }
    public static function displayReportPath(){
	return URL::to('/').'/storage/reports/';
    }
    public static function displayBlogimagePath(){
        return URL::to('/').'/storage/blog/';
    }
    public static function displayFilePath(){
        return URL::to('/').'/storage/files/';
    }
    public static function displayProductPath(){
        return URL::to('/').'/storage/product/';
    }
   
   
    public static function GetCsvFromArrayProperty($array,$propertyName) {
        $csv = "";
        for( $i = 0; $i < count($array); $i++ ) {
            
            $csv .= str_replace('"', '""', $array[$i]->$propertyName);
            if( $i < count($array) - 1 ) $csv .= ",";
        }
        return $csv;
    }
    
    public static function getRoleArray(){
        return array(
                "1" => "Super Admin",
                "2" => "Shop Super Admin",
                "3" => "Shop Manager",
                "4" => "Chain Shop Manager",
                "5" => "Shop Staff",
                "6" => "Consumers",
            );
    }

    public static function getLatLong($address){
        if(!empty($address)){
            //Formatted address
            $formattedAddr = str_replace(' ','+',$address);

            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$formattedAddr&key=".config('const.googleMapKey')."");
            $output = json_decode($geocodeFromAddr);
            
            if(isset($output->status) && $output->status=="OK"){
                //Get latitude and longitute from json data
                $data['latitude']  = $output->results[0]->geometry->location->lat; 
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }else{
                $data['latitude'] = NULL;
                $data['longitude'] = NULL;
            }
            
            //Return latitude and longitude of the given address
            if(!empty($data)){
                return $data;
            }else{
                $data['latitude'] = NULL;
                $data['longitude'] = NULL;
            }
        }else{
            $data['latitude'] = NULL;
            $data['longitude'] = NULL;  
        }
    }
    
    public static function getTimezone(){
        if(Session::get('customTimeZone') && Session::get('customTimeZone') !='')
            return Session::get('customTimeZone');
        else
            return "Europe/Berlin";
    }
    
    public static function displayDateTimeConvertedWithFormat($date,$format=''){
        if(!$format){
            $format= config('const.displayDateTimeFormatForAll');
        }
        
        $dt = new DateTime($date);
        $tz = new DateTimeZone(Helper::getTimezone()); // or whatever zone you're after

        $dt->setTimezone($tz);
        return $dt->format($format);
    }
    
    public static function  push_notification($data){
        $path_to_firebase_cm = env('FIREBASE_CM_URL');
        $google_api_key = env('FIREBASE_CM_KEY');
        
        $headers = array
        (
            'Authorization: key=' . $google_api_key, 
            'Content-Type: application/json'
        );                                                                                 
                                                                                                        
        $ch = curl_init();  

        curl_setopt( $ch,CURLOPT_URL, $path_to_firebase_cm );                                                                  
        curl_setopt( $ch,CURLOPT_POST, true );  
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data);                                                                  
                                                                                                                            
        curl_exec($ch);

        curl_close ($ch);
        return true;
    }
    
    public  static function generateRandomString($length =20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public static function getMenuPermission($menuID,$userID=''){
        if($userID==''){
            $userID = Auth::user()->id;
        }
        return MenuPermission::where('user_id', $userID )->where('menu_id',$menuID)->first();
    }
    
    public static function getStatusArray(){
     return   array(
                'active'=>"Active",
                'inactive'=>"InActive",
                'locked'=>"locked",
            );
    }
    
    public static function removeBrackate($row){
        return substr($row,
                    $start = strspn($row, '('),
                    strcspn($row, ')') - $start
             );
    }
    
    public static function BugStatus($data) {
	if ($data->status == config('const.statusOpen')) {
		return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Open</span>';
	}else if($data->status == config('const.statusClose')){
		return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Close</span>';
	}else if($data->status == config('const.statusReopen')){
		return '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">Reopen</span>';
	}else if($data->status == config('const.statusNotFound')){
		return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Not Found</span>';
	}else if($data->status == config('const.statusResolve')){
		return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill" style="background: green;">Resolve</span>';
	} else {
		return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
	}
    }

    public static function getbugStatusArray(){
        return array(
                'open'=>"Open",
                'close'=>"Close",
                'reopen'=>"Reopen",
                'notfound'=>"Not Found",
                'resolve'=>"Resolve",
        );
    }
    
    public static function SupportStatus($data) {
	if ($data->status == config('const.statusOpen')) {
		return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Open</span>';
	}else if($data->status == config('const.statusClose')){
		return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Close</span>';
	}else if($data->status == config('const.statusReopen')){
		return '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">Reopen</span>';
	}else if($data->status == config('const.statusResolve')){
		return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill" style="background: green;">Resolve</span>';
	} else {
		return '<button type="button" class="btn red btn-xs pointerhide cursornone">---</button>';
	}
    }
    
    public static function getsupportStatusArray(){
	return array(
            'open'=>"Open",
            'close'=>"Close",
            'reopen'=>"Reopen",
            'resolve'=>"Resolve",
        );
    }
    
    public static function cmsType(){
	return array(
            'content'=>"Content",
            'url'=>"URL",
            'video_url'=>"Video URL",
            'video_file'=>"Video File",
            'pdf'=>"PDF",
        );
    }
    
    public static function getPlanStatusArray(){
        return   array(
                   'active'=>"Active",
                   'inactive'=>"InActive",
               );
    }
    
    public static function displayIcon($ext1){
        $ext = strtolower($ext1);
        $icon = '';
        if($ext=='jpeg' || $ext=='jpg' || $ext=='png' || $ext=='gif'){
            $icon = "image";
        }elseif($ext=='pdf'){
            $icon = "pdf";
        }else{
            $icon = "file";
        }
        return $icon;
    }
    
    public static function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null,$page = null)
    {
        $pageName = 'page';
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $page     = $page ?: ($currentPage ?: 1);
        $items    = $collection instanceof Collection ? $collection : Collection::make($collection);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path'     => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}
