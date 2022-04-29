<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendStudentsInSubscribersCourseNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $SendInofStuednts ;
    public function __construct($param)
    {
        $this->SendInofStuednts = $param ;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

  
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        
        return [
           
            'title' =>  $this->SendInofStuednts['title'] ,
            'body' => $this->SendInofStuednts['body'],
            'courseId' => $this->SendInofStuednts['courseId'],
            'instructorName' =>   $this->SendInofStuednts['instructorName'] ,
            'instructorImg' =>   $this->SendInofStuednts['instructorImg'] ,


        ];
    }
}
