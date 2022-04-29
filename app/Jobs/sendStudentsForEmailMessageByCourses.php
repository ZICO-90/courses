<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendStudentsForEmailMessageByCourses implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $message;
    private $listEmailStudents;
  
    public function __construct($msg , $listEmail)
    {
        $this->message = $msg;
        $this->listEmailStudents = $listEmail;
      
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     
       
     
        foreach( $this->listEmailStudents->student_course as $sendEmail){

            sendMail('sites.mail.sednEmail', $this->message , $sendEmail->email , $this->listEmailStudents->title);
        }
    }
}
