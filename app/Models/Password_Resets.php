<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Event;
use App\Jobs\SendEmailJob;

class Password_Resets extends Model
{   
    protected $table = 'password_resets';
    public $timestamps = false;
    protected $primaryKey ='email';
	
    protected $fillable = [
        'email','token','created_at'
    ];
    
    public function forgotLink($token,$email,$isMobile='',$name='')
    {
        dispatch(new SendEmailJob([
            '_blade'=>'forgot',
            'subject'=>trans('email.resetPassword'),
            'email'=>$email,
            'name'=>$name,
            'token'=>$token,
            'ismobile'=>$isMobile
        ]));
    }
    
    public static function forgotLinkMobile($email,$name='',$code){
        dispatch(new SendEmailJob([
            '_blade'=>'forgotmobile',
            'subject'=>trans('email.resetPasswordMobile'),
            'email'=>$email,
            'code'=>$code,
            'name'=>$name
        ]));
    }
    
    public function lockedForgotPasswordLink($token,$email,$isMobile='',$name=''){
        dispatch(new SendEmailJob([
            '_blade'=>'forgotlocked',
            'subject'=>trans('email.resetPasswordLockedAccount'),
            'email'=>$email,
            'name'=>$name,
            'token'=>$token,
            'ismobile'=>$isMobile
        ]));
    }
}
