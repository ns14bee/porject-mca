<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\admin\NotificationController;

class SendCommonSinglePushNotifications //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data['notify_id'] = $this->data['notify_id'];
        $data['post_id'] = $this->data['post_id'];
        $data['user_id'] = $this->data['user_id'];
        $data['notification_for'] = $this->data['notification_for'];
        $data['message'] = $this->data['message'];
        NotificationController::store($data);
        //app('App\Http\Controllers\admin\NotificationController')->store($data);
    }
}
