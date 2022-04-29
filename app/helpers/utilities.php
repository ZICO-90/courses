<?php


function sendMail($template, $message ,$EmailSender ,$subjectTitleCourse ){
  
 

  
    \Mail::send($template,['data'=> $message ],function($message)use($EmailSender,$subjectTitleCourse ){
        $message-> subject($subjectTitleCourse);
        $message-> to($EmailSender);
        
    });
  
}