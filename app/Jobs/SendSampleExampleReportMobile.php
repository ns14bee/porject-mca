<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use Illuminate\Support\Facades\DB;
use URL;

class SendSampleExampleReportMobile //implements ShouldQueue
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
        $emailData = $this->data;
        Mail::send('mail.report1', ["data"=>$emailData], function($message) use ($emailData) {
            $message->to($emailData['email']); //
            $message->subject(trans('email.subjectExampleReport'));
            
            $message->attach($emailData['report1'], [
                'as' => 'report1.pdf', 
                'mime' => 'application/pdf'
            ]);
            $message->attach($emailData['report2'], [
                'as' => 'report2.pdf', 
                'mime' => 'application/pdf'
            ]);
            $message->attach($emailData['report3'], [
                'as' => 'report3.pdf', 
                'mime' => 'application/pdf'
            ]);
            $message->attach($emailData['report4'], [
                'as' => 'report4.pdf', 
                'mime' => 'application/pdf'
            ]);
            $message->attach($emailData['report5'], [
                'as' => 'report5.pdf', 
                'mime' => 'application/pdf'
            ]);
            $message->attach($emailData['report6'], [
                'as' => 'report6.pdf', 
                'mime' => 'application/pdf'
            ]);
        });
        
    }
}
