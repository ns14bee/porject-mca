<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use URL;
use App\Helpers\Helper;
use App\Jobs\SendEmailJob;
use Crypt;
use Illuminate\Support\Facades\Hash;
use App\Password_Resets;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Jobs\SendCommonSinglePushNotifications;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['created_at','updated_at', 'join_date'];

    public function getroleusers() {
        return $this->belongsTo('App\Models\Role','role_id');
    }
    
    public function getdepartmentusers() {
        return $this->belongsTo('App\Models\Department','department_id');
    }

    public function getattendanceusers() {
        return $this->belongsTo('App\Models\Attendance','user_id');
    }

    public function getfullnameAttribute(){
        $firstName = ucfirst($this->name)   ;
        //$lastName= ucfirst($this->last_name);
        return "{$firstName}";
    }
    
    
    public static function getUserDetails($id){
        $data = User::find($id);
        if($data){
            if(isset($data->profile_pic) && $data->profile_pic!=''){
                $data->profile_pic = Helper::displayProfilePath().''.$data->profile_pic;
            }else{
                $data->profile_pic = URL::to('/').'/assets/media/users/default.jpg';
            }
        }
        return $data;
    }
    
    public static function updateMyProfile($request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $profilelogoName = $data->profile_pic;
        if(isset($request->profile_pic) && $request->profile_pic !=''){
            
            /* Unlink Image */
            if(isset($data->profile_pic) && $data->profile_pic!=''){
                $imagePath = Helper::profileFileUploadPath().''.$data->profile_pic;
                if(file_exists($imagePath)){
                    unlink($imagePath);    
                }
            }
            
            $profilelogo   = $request->profile_pic;
            $profilelogoName = 'Profile-'.time().'.'.$request->profile_pic->getClientOriginalExtension();
            $profilelogo->move(Helper::profileFileUploadPath(), $profilelogoName);    
        }
        $data->profile_pic = $profilelogoName;
        $data->save();
        return self::getUserDetails($data->id);
    }
    
    public static function signIn($request){
        
        /* For Manage User is invited user or normal start*/
        $parentUserID = NULL;
        $InviteData = [];
        $roleID =  config('const.roleUserMaster');
        if(isset($request->code) && $request->code !=''){
            $parentUserData = User::where('code',$request->code)->first();
            if($parentUserData){
                
                if(isset($request->parent_user_id) && $request->parent_user_id!=''){
                    $parentUserID = $request->parent_user_id;
                }else{
                    $parentUserID = $request->id;
                }
                
                $InviteData = UserInvitee::where('email',$request->email)->first();
                if($InviteData){
                    UserInvitee::where('email',$request->email)->update(['status' =>config('const.statusActive')]);
                    if (isset($InviteData) && $InviteData->permission == 'master') {
                        $roleID = config('const.roleUserMaster');
                    } else {
                        $roleID = config('const.roleUserInvited');
                    }
                    $parentUserID = $InviteData->user_id;
                }else{
                    $parentUserID = NULL;
                    $roleID =  config('const.roleUserMaster');
                }   
            }else{
                $InviteData = UserInvitee::where('email',$request->email)->first();
                if($InviteData){
                    UserInvitee::where('email',$request->email)->update(['status' =>config('const.statusActive')]);
                    if(isset($InviteData) && $InviteData->permission=='master'){
                        $roleID =  config('const.roleUserMaster');
                    }else{
                        $roleID = config('const.roleUserInvited');  
                    }
                    $userData = User::find($InviteData->user_id);
                    if(isset($userData->parent_user_id) && $userData->parent_user_id!=''){
                        $parentUserID = $userData->parent_user_id;
                    }else{
                        $parentUserID = $userData->id;
                    }
                }else{
                    $parentUserID = NULL;
                    $roleID =  config('const.roleUserMaster');
                }
                //$roleID = config('const.roleUserInvited');     
            }
        }
        /* For Manage User is invited user or normal end*/
        
        
        
        
        
        $data = new User();
        $data->name = $request->name;
        if($parentUserID){
            $data->parent_user_id = $parentUserID;
        }
        $data->code = IdGenerator::generate(['table' => 'users', 'length' =>8, 'prefix' =>config('const.userCodePrefix'),'field'=>'code']);
        $data->recovery_email = isset($request->recovery_email)?$request->recovery_email:NULL;
        $data->password =  bcrypt($request->password);
        $data->email =  $request->email;
        $data->role_id = $roleID;
        $data->status =  config('const.statusActive');
        $data->save(); 
        $data->SignupConfirmation();
        
        
        /* For Manage Role Change */
        if($parentUserID && $roleID==config('const.roleUserMaster')){
            
            /* For Logout from Device */
            $query= User::where('id','!=',$data->id);
                    if($parentUserID){
                        $query->where('parent_user_id',$parentUserID)
                        ->orWhere('id',$parentUserID);
                    }
            $logoutUser = $query->pluck('id');
            $notificationUserData = $query->get();
            
            
            User::where('parent_user_id',$parentUserID)->update(['parent_user_id' =>$data->id]);
            UserInvitee::where('user_id',$parentUserID)->update(['user_id' =>$data->id]);
            //UserInvitee::where('email',$data->email)->delete();
            User::where('id',$parentUserID)->update(['parent_user_id' =>$data->id,'role_id'=>config('const.roleUserInvited')]);
            User::where('id',$data->id)->update(['parent_user_id' =>NULL]);
            $userData = User::find($parentUserID);
            Decease::where('user_id',$parentUserID)->update(['user_id' =>$data->id]);
            if($userData){
                $emailData = UserInvitee::where('email',$userData->email)->first();
                if($emailData){
                    $emailData->permission = config('const.permissionWrite');
                    $emailData->save();
                }else{
                    $a = New UserInvitee();
                    $a->user_id = $data->id;
                    $a->email = $userData->email;
                    $a->first_name = $userData->name;
                   // $a->last_name = $userData->name;
                    $a->status =  config('const.statusActive');
                    $a->invite_url =  NULL;
                    $a->permission = config('const.permissionWrite');
                    $a->save();
                }
            }
            
            $inserttedID = $data->id;
            
            if($notificationUserData){
                foreach ($notificationUserData as $notificationUserData1){
                    self::sendNotificationOnMasterRoleChange($notificationUserData1,$request->name,$inserttedID);
                }
            }
            
            if($logoutUser){
               \DB::table('oauth_access_tokens')->whereIn('user_id',$logoutUser)->update([
                    'revoked' => true
                ]);
            }
            
        } 
        
        /* sendNotificationOnInvitationRegistartion */
        if($InviteData){
            User::sendNotificationOnInvitationRegistartion($data,$InviteData);
        }
        return $data;
    }
    
    public static function sendNotificationOnMasterRoleChange($data,$name,$id){
        if($data){             
            $notifications['notify_id'] = $data->id;
            $notifications['post_id'] = $id;
            $notifications['user_id'] = $id;
            $notifications['notification_for'] = 'master role change';
            $notifications['message'] = $name." become a new master user. Please login again";
            
            $SendCommonSinglePushNotifications = new SendCommonSinglePushNotifications($notifications);
            dispatch($SendCommonSinglePushNotifications); 
        }
    }
    
    public static function sendNotificationOnInvitationRegistartion($data,$InviteData){
        if($data && $InviteData){
            $userData = User::find($InviteData->user_id);
            $notifications['notify_id'] = $InviteData->user_id;
            $notifications['post_id'] = $InviteData->id;
            $notifications['user_id'] = $data->id;
            $notifications['notification_for'] = 'User Invite Accept';
            $notifications['message'] = $data->name." joined you";
            Http\Controllers\admin\NotificationController::store($notifications);
//            $SendCommonSinglePushNotifications = new SendCommonSinglePushNotifications($notifications);
//            dispatch($SendCommonSinglePushNotifications); 
        }
    }

    public function SignupConfirmation(){     
        dispatch(new SendEmailJob([
            '_blade'=>'registration',
            'subject'=>trans('email.normal_regsubject'),
            'email'=>$this->email,
            'name'=>  ucfirst($this->name),
            'token'=>Crypt::encryptString($this->email),
            'url'=>URL::to('/').'/registration-confirmation/'.Crypt::encryptString($this->email),
        ]));
    }
    
    public static function lockedAccount($request){
        $data = User::where('email',$request->email)->where('status',config('const.statusActive'))->first(); //->where('status',config('const.statusActive'))
        if($data){
            if(!Hash::check($data->password,$request->password)){
                    $data->wrong_attempt_count = $data->wrong_attempt_count+1;
                    $data->save();
                if($data->wrong_attempt_count >= 5){
                    $data->status = config('const.statusLocked');
                    $data->save();
                    
                    $token = Crypt::encryptString($request->email);
                    Password_Resets::updateOrCreate(
                    [
                        'email' => $request->email
                    ], [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                    ])->lockedForgotPasswordLink($token, $request->email,'',$data->fullName);
                }
            }
        }
        return isset($data->wrong_attempt_count)?$data->wrong_attempt_count:0;
    }
    
    /* Admin Store User  Start*/
    public function sendCreationEmailToAnyAdminUsers($password){     
        dispatch(new SendEmailJob([
            '_blade'=>'adminusercreation',
            'subject'=>trans('email.adminusercreation'),
            'email'=>$this->email,
            'name'=>  ucfirst($this->name),
            'url'=> URL::to('/').'/login',
            'password'=> $password,
        ]));
    }
    
    public static function addUser($request){
        $data = new User();
        $data->name = $request->name;
        $data->code = IdGenerator::generate(['table' => 'users', 'length' =>8, 'prefix' =>config('const.userCodePrefix'),'field'=>'code']);
        $data->role_id = $request->role_id;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);        
        $data->department_id = $request->department_id;
        $data->email_verified_at = Carbon::now();
        $data->status = config('const.statusActive');
        $data->save();
        $data->sendCreationEmailToAnyAdminUsers($request->password);
        return $data;
    }
    /* Admin Store User End*/
    
    /* Admin Update User Start */
    public static function editUser($id,$request){
        
        $dataOld = User::find($id);
        $data = User::find($id);
        $data->name = $request->name;
        $data->role_id = $request->role_id;
        $data->email = $request->email;
        $data->status = $request->status;       
        $data->department_id = $request->department_id;
        $data->save();
        
        if($data){
            if(isset($dataOld->email) && $dataOld->parent_user_id !='' && $dataOld->email != $request->email){
                UserInvitee::where('email',$dataOld->email)->update(['email' => $request->email]);
            }
        }
        
        
        if($dataOld->parent_user_id !='' && isset($request->permissions)  &&  $request->role_id==config('const.roleUserInvited')){
            UserInvitee::where('email',$request->email)->update(['permission' => $request->permissions]);
            if($request->permissions=='master'){
                $userPermi = User::find($id);
                $userPermi->role_id = config('const.roleUserMaster');
                $userPermi->save();
            }else{
                $userPermi = User::find($id);
                $userPermi->role_id = config('const.roleUserInvited');
                $userPermi->save();
            }
        }   
        
        /* Master Flow Change */
        if($dataOld->role_id==config('const.roleUserInvited') && $request->role_id==config('const.roleUserMaster')){
            
            /* For Logout from Device */
            $query = User::where('parent_user_id',$dataOld->parent_user_id)
                            ->orWhere('id',$dataOld->parent_user_id);
            
            $logoutUser = $query->pluck('id');
            $notificationUserData = $query->get();
            
            User::where('parent_user_id',$dataOld->parent_user_id)->update(['parent_user_id' =>$data->id]);
            UserInvitee::where('user_id',$dataOld->parent_user_id)->update(['user_id' =>$data->id]);
            UserInvitee::where('email',$request->email)->update(['permission' =>'master']);
            //UserInvitee::where('email',$data->email)->delete();
            User::where('id',$dataOld->parent_user_id)->update(['parent_user_id' =>$data->id,'role_id'=>config('const.roleUserInvited')]);
            User::where('id',$data->id)->update(['parent_user_id' =>NULL]);
            $userData = User::find($dataOld->parent_user_id);
            Decease::where('user_id',$dataOld->parent_user_id)->update(['user_id' =>$data->id]);
            if($userData){
                $emailData = UserInvitee::where('email',$userData->email)->first();
                if($emailData){
                    $emailData->permission = config('const.permissionWrite');
                    $emailData->save();
                }else{
                    $a = New UserInvitee();
                    $a->user_id = $data->id;
                    $a->email = $userData->email;
                    $a->first_name = $userData->name;
                   // $a->last_name = $userData->name;
                    $a->status =  config('const.statusActive');
                    $a->invite_url =  NULL;
                    $a->permission = config('const.permissionWrite');
                    $a->save();
                }
            }
            
            if($notificationUserData){
                foreach ($notificationUserData as $notificationUserData1){
                    self::sendNotificationOnMasterRoleChange($notificationUserData1,$request->name,$id);
                }
            }
            
            if($logoutUser){
               \DB::table('oauth_access_tokens')->whereIn('user_id',$logoutUser)->update([
                    'revoked' => true
                ]);
            }
            
           
        }
        
    }
    /* Admin Update User End*/
    
    /* Admin User List Start */
    public static function postUsersList($request){
        
        $query = User::select('users.*','role.name as role_name','department.dept_name as deptartment_name')
        ->leftJoin('role', 'role.id', '=', 'users.role_id')
        ->leftJoin('department', 'department.id', '=', 'users.department_id')
        ->where('role_id',2);
        if($request->order ==null){
            $query->orderBy('users.id','desc');
        }
        
        $searcharray = array();    	
    	parse_str($request->fromValues,$searcharray);
        
        if(isset($searcharray) && !empty($searcharray)){
            // if($searcharray['status'] !=''){				
            //         $query->where("users.status",'=',$searcharray['status']);
            // }
            if($searcharray['role_id'] !=''){				
                    $query->where("users.role_id",'=',$searcharray['role_id']);
            }
        }
      
        return Datatables::of($query)
            ->addColumn('status', function ($data) {
               return Helper::Status($data);
            }) 
            ->addColumn('action', function ($data) {
               $userPer = Helper::getMenuPermission(1,Auth::user()->id);
               $recoverylink = '';
               if(Auth::user()->role_id == config('const.roleAdmin')  ||  (isset($userPer) &&  $userPer->write==1)){
                   $editLink = URL::to('/').'/admin/employee/'.$data->id.'/edit';
                   $deleteLink = $data->id;
                   if($data->role_id == config('const.roleUserMaster')){
                       $recoverylink = $data->id;
                   }
               }else{
                   $editLink = '';
                   $deleteLink = '';
                   $recoverylink = '';
               }
               if($data->role_id==config('const.roleAdmin')){
                   $editLink = '';
                   $deleteLink = '';
                   $recoverylink = '';
               }
               $viewLink = URL::to('/').'/admin/employee/'.$data->id;
               
               return Helper::Action($editLink,$deleteLink,$viewLink,$recoverylink);   
            }) 
            ->rawColumns(['status','action'])
            ->make(true);
    }
    
    
    /* Send Reset password Email */
    public static function sendResetPasswordEmail($id){    
        $password = Helper::generateRandomString(5).'@Y20';
        $data = User::find($id);
        $data->password = Hash::make($password);
        $data->wrong_attempt_count = 0;
        $data->save();
            dispatch(new SendEmailJob([
                '_blade'=>'resetpasswordofuser',
                'subject'=>trans('email.resetpasswordofuser'),
                'email'=>$data->email,
                'name'=>  ucfirst($data->name),
                'url'=> URL::to('/').'/login',
                'password'=> $password,
            ]));
        
        return $data;
    }

    public static function activeDepartmentReceptionsCount(){
        $query = User::where('department_id',5);
        return $query->count();
    }

    public static function activeDepartmentProjectsCount(){
        $query = User::where('department_id',4);
        return $query->count();
    }

    public static function activeDepartmentMarketingCount(){
        $query = User::where('department_id',3);
        return $query->count();
    }

    public static function activeDepartmentAccountCount(){
        $query = User::where('department_id',1);
        return $query->count();
    }
}
