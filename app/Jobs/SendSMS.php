<?php

namespace App\Jobs;

use App\DispatchCustomer;
use App\Jobs\Job;
use App\SMSDistributionList;
use App\SMSLog;
use App\SMSMessages;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMS extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $msg;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if($this->msg->dispatch_id != null && $this->msg->dispatch_id != "")
        {
            $dispatch=DispatchCustomer::where('dispatch_id','=',$this->msg->dispatch_id)->get();

            foreach($dispatch as $dlst)
            {
                $phone=$dlst->customers->phone;
                $messages= $this->msg->message;
                $messagesurl=urlencode($messages);
                $url = "http://192.168.1.161:8800/?PhoneNumber=$phone&Text=$messagesurl&ReceiptRequested=Yes";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);

                //Create dispatch logs
                $smslog = new SMSLog;
                $smslog->phone=$phone;
                $smslog->message=$messages;
                $smslog->status="Sent";
                $smslog->message_id=$this->msg->id;
                $smslog->dispatch_date=date("Y-m-d");
                $smslog->dispatch_date_tm=date("Y-m-d H:i");
                $smslog->dispatch_date_tm=date("Y-m-d H:i");
                $smslog->save();

            }
            //Update Message status
            $msgDisp= SMSMessages::find($this->msg->id);
            $msgDisp->sent_time=date('Y-m-d H:i');
            $msgDisp->sent_date=date('Y-m-d');
            $msgDisp->status="Sent";
            $msgDisp->save();
        }
    }
}
