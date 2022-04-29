<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\courses\LessonAddRequest;
use App\Models\Lesson;
use App\Http\Traits\ImagesTrait;
use Illuminate\Support\Str;
use App\Http\Requests\courses\LessonUpdateRequest;
use Owenoj\LaravelGetId3\GetId3;
use Alaouy\Youtube\Facades\Youtube;
use DateInterval;
class LessonsController extends Controller
{
    use ImagesTrait ;
    public function lessonAdd(LessonAddRequest $request)
    {
        
        $encryptedId_course_id = \Illuminate\Support\Facades\Crypt::decrypt($request->validation_lecture_id);

              $duration = null ;
              if($request->has('up_video_lecture_'. $encryptedId_course_id))
              {
               
               
                      $file_lecture = $request->file('file_lecture_'. $encryptedId_course_id) ;

                      $video = new GetId3($file_lecture); //اقرأ عن الكلاس ده واجمع عنه خصائصه
          
                      $duration = date('H:i:s', $video->extractInfo()['playtime_seconds']);
                       
                     
                      $filename = time().hash('sha256' , Str::random(120)) . '.' . $file_lecture->getClientOriginalExtension();
                     
                      $is_path_public = 'site/assets/uploads/courses/lesson/';
                     
                      $this->uploadImage($file_lecture ,$filename,$is_path_public);
                      
                      $request['url_lecture_'.$encryptedId_course_id] = $is_path_public . $filename ;

                    
                     
               
              }else{
                parse_str(parse_url($request['url_lecture_'.$encryptedId_course_id],PHP_URL_QUERY),$urlArray);
                $video_id=$urlArray['v']; 

                $video = Youtube::getVideoInfo(  $video_id);
                $video_duration = new DateInterval($video->contentDetails->duration);//اقرأ عن الكلاس ده واجمع عنه خصائصه
                $duration =  $video_duration->format('%H:%I:%S');
               }

  

        $insert_lesson = [
            'name' => $request['lecture_name_'.$encryptedId_course_id] ,
            'detalis' => $request['lecture_details_'.$encryptedId_course_id] ,
            'url_video' => $request['url_lecture_'.$encryptedId_course_id],
            'url_type' => $request->has(['up_video_lecture_'.$encryptedId_course_id]) ? 1 : 0,
            'time' => $duration ,
            'external_link_file' => $request['external_link_file_'.$encryptedId_course_id],
            'sort_display_video' => $request['add_sort_number_'.$encryptedId_course_id],
            'cource_id' => $encryptedId_course_id, // this course id
            
        ];

   
        Lesson::create($insert_lesson);

        return redirect()->back()->with(['info' =>  "تمت اضافة الدرس بنجاح"]);

    }



    public function update(LessonUpdateRequest $request)
    {

        
        $encryptedId_lesson_id = \Illuminate\Support\Facades\Crypt::decrypt($request->edit_validation_lesson_id);

       $lesson = Lesson::findOrFail( $encryptedId_lesson_id);

        if($request->has('edit_up_video_lecture_'. $encryptedId_lesson_id))
        {
         
         
         
                $file_lecture = $request['edit_file_lecture_'. $encryptedId_lesson_id] ;


                $file = $request['edit_file_lecture_'. $encryptedId_lesson_id] ;
                if($file_lecture != null)
                {
                    
                    $track = new GetId3( $file_lecture ); 
          
                    $duration = date('H:i:s', $track->extractInfo()['playtime_seconds']);

                    $filename = time().hash('sha256' , Str::random(120)) . '.' . $file_lecture->getClientOriginalExtension();
               
                    $is_path_public = 'site/assets/uploads/courses/lesson/';
                    
                    $this->uploadImage($file ,$filename,$is_path_public , $lesson->url_video);
                    

                  
                    $lesson->url_video = $is_path_public . $filename ;

                   

                    $lesson->time = $duration  ;
                }
               
         
        }else{
            if($lesson->url_video !==  trim( $request['edit_url_lecture_'.$encryptedId_lesson_id]))
            {
               
                parse_str(parse_url($request['edit_url_lecture_'.$encryptedId_lesson_id],PHP_URL_QUERY),$urlArray);
                $video_id=$urlArray['v']; 

                $video = Youtube::getVideoInfo(  $video_id);
                $video_duration = new DateInterval($video->contentDetails->duration);
                $lesson->url_video = $request['edit_url_lecture_'.$encryptedId_lesson_id] ;
                $lesson->time =  $video_duration->format('%H:%I:%S');
            }
           
        }

        $lesson_update = [
            'name' => $request['edit_lecture_name_'.$encryptedId_lesson_id] ,
            'detalis' => $request['edit_lecture_details_'.$encryptedId_lesson_id] ,
            'url_type' => $request->has(['edit_up_video_lecture_'.$encryptedId_lesson_id]) ? 1 : 0,
            'external_link_file' => $request['edit_external_link_file_'.$encryptedId_lesson_id],
            'sort_display_video' => $request['edit_add_sort_number_'.$encryptedId_lesson_id],
           
            
        ];

        $lesson->update($lesson_update) ;
        $message =   " بنجاح " . $lesson->name  . " تم تعديل المحاضرة : " ;
        return redirect()->back()->with(['info' =>  $message]);

        
    }

    public function delete($deleteById)
    {
     
        $lesson = Lesson::findOrFail( $deleteById);
        $lesson->delete();

        if( (bool) $lesson->url_type )
        \Illuminate\Support\Facades\File::delete($lesson ->url_video);

        $message =   " بنجاح " . $lesson->name  . " تم حذف الدرس: " ;
        return redirect()->back()->with(['info' =>  $message ]);

    }
}
