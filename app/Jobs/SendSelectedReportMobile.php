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

class SendSelectedReportMobile //implements ShouldQueue
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
        $req = $this->data;
        $request = (object) $req;
        
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");

        $deceaseDetails = \App\Decease::with('user')->where('id',$request->decease_id)->first();
        $deceaseDetails->current_date = isset($request->current_date)?$request->current_date:'';
        $deceaseDetails->current_time = isset($request->current_time)?$request->current_time:'';


        $report1mpdf = [];
        if(isset($request->report1) && $request->report1!='' && $request->report1==1){
            $report1 = \App\Report::report1($request);
            $report1mpdf = \PDF::loadView('admin.reports.report1',array('data'=>$report1,'deceaseDetails'=>$deceaseDetails),[], ['orientation' => 'L']); //// 'orientation' => 'L'
        }

        $report2mpdf = [];
        if(isset($request->report2) && $request->report2!='' && $request->report2==2){
            $report2 = \App\Report::report2($request);
            $report2mpdf = \PDF::loadView('admin.reports.report2',array('data'=>$report2,'deceaseDetails'=>$deceaseDetails),[], []); //// 'orientation' => 'L'
        }

        $report3mpdf = [];
        if(isset($request->report3) && $request->report3!='' && $request->report3==3){
            $report3 = \App\Report::report3($request);
            $report3mpdf = \PDF::loadView('admin.reports.report3',array('data'=>$report3,'deceaseDetails'=>$deceaseDetails),[], []); //// 'orientation' => 'L'
        }

        $report4mpdf = [];
        if(isset($request->report4) && $request->report4!='' && $request->report4==4){
            $report4 = \App\Report::report4($request);
            $report4mpdf = \PDF::loadView('admin.reports.report4',array('data'=>$report4,'deceaseDetails'=>$deceaseDetails),[], []); //// 'orientation' => 'L'
        }

        $report5mpdf = [];
        if(isset($request->report5) && $request->report5!='' && $request->report5==5){
            $report5 = \App\Report::report5($request);
            $report5mpdf = \PDF::loadView('admin.reports.report5',array('data'=>$report5,'deceaseDetails'=>$deceaseDetails),[], ['orientation' => 'L']); //// 'orientation' => 'L'
        }

        $report6mpdf = [];
        if(isset($request->report6) && $request->report6!='' && $request->report6==6){
            $report6 = \App\Report::report6($request);
            $report6mpdf = \PDF::loadView('admin.reports.report6',array('data'=>$report6,'deceaseDetails'=>$deceaseDetails),[], []); //// 'orientation' => 'L'
        }

        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");

        $emailData = [];
        $emailData['name'] = $request->name;
        Mail::send('mail.report1', ["data"=>$emailData], function($message) use ($report1mpdf,$report2mpdf,
            $report3mpdf,$report4mpdf,$report5mpdf,$report6mpdf,$request) {
            $message->to($request->email); //$notify['email']
            $message->subject(trans('email.subjectReport'));
            if(isset($request->report1) && $request->report1!='' && $request->report1==1){
                $message->attachData($report1mpdf->Output(),'Report1.pdf');
            }
            if(isset($request->report2) && $request->report2!='' && $request->report2==2){
                $message->attachData($report2mpdf->Output(),'Report2.pdf');
            }
            if(isset($request->report3) && $request->report3!='' && $request->report3==3){
                $message->attachData($report3mpdf->Output(),'Report3.pdf');
            }
            if(isset($request->report4) && $request->report4!='' && $request->report4==4){
                $message->attachData($report4mpdf->Output(),'Report4.pdf');
            }
            if(isset($request->report5) && $request->report5!='' && $request->report5==5){
                $message->attachData($report5mpdf->Output(),'Report5.pdf');
            }
            if(isset($request->report6) && $request->report6!='' && $request->report6==6){
                $message->attachData($report6mpdf->Output(),'Report6.pdf');
            }
        });
    }
}
