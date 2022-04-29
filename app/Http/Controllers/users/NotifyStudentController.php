<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\UserCource;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendStudentsInSubscribersCourseNotify;
use App\Jobs\sendStudentsForEmailMessageByCourses;
use App\Models\Course;
class NotifyStudentController extends Controller
{
    public function sendAllStudents(Request $request)
    {
       
        $message =
         [
            'required' => "جميع بيانات التنويه مطلوبة من فضل ادخل البيانات بشكل صحصح" ,
            'title.min' => "العنوان لا يقل عن 6 احرف ولا يزيد عن 255 حرفا" ,
            'title.max' => 'العنوا لقد تجاوز عدد الاحرف 255 المسموح بها' ,
            'body.min' => 'يجب ان لا يقل مضمون الرساله عن 6 احرف ولا يزيد عن 65535 حرفا',
            'body.max' => "لقد تجاوز مضمون الرساله العدد 65535 المسموح بها" ,

         ];

         $request->validate([
            'title' => 'required|string|min:6|max:255',
            'body' => 'required|string|min:6|max:65535',
          ],$message);

            try {

            $courseId =Crypt::decrypt($request->courseId);
            $instructorId =Crypt::decrypt($request->instructorId);
            } catch (DecryptException $e) 
            {
                return back()->with(['info' => "من فضلك اعد المحاولة بشكل صحيح" ]);    
            }



        $instructorInfo =   User::findOrFail($instructorId);
           
        $data =[
            'title' =>$request->title ,
            'body'  =>$request->body ,
            'courseId' =>  $courseId,
            'instructorName' =>  $instructorInfo->username ,
            'instructorImg' =>  $instructorInfo->avatar ,


         ];


       
        $result = UserCource::where('cource_id' , $courseId )->get();

        if(sizeof($result) === 0)
        return back()->with(['info' => "حالة الارسال: لا يوحد مشتركين بهذه الدورة" ]);  

        $getStudentId = $result->map(function($query){
            return $query->student_id ;
        })->toArray() ;

    $sendStudents =    User::whereIn('id' , $getStudentId )->get();
   
    Notification::send($sendStudents, new SendStudentsInSubscribersCourseNotify($data));
       

    return back()->with(['info' => "تم ارسال الي جميع الطلاب المشتركين في الدورة التنويه" ]);  

    }


    public function showNotify($id)
    {
        try {

            $id =Crypt::decrypt($id);
    
            } catch (DecryptException $e) 
            {
                return back()->with(['info' => "من فضلك اعد المحاولة بشكل صحيح" ]);    
            }

       $getNotify =  Course::findOrFail($id);
     
    
       return view('sites.coursesPages.notify', compact('getNotify'));
    }

    public function senEmailMessage(Request $request )
    {

        $message =
        [
           'required' => "جميع بيانات التنويه مطلوبة من فضل ادخل البيانات بشكل صحصح" ,
           'message.min' => "الرساله لا يقل عن 6 احرف ولا يزيد عن 255 حرفا" ,
         
         

        ];

        $request->validate([
           'message' => 'required|string|min:6',
           'courseId' => 'required',
         ],$message);
         
        try {

            $idCourse =Crypt::decrypt($request->courseId);
    
            } catch (DecryptException $e) 
            {
                return back()->with(['info' => "من فضلك اعد المحاولة بشكل صحيح" ]);    
            }

          $getStudent =   Course::findOrFail($idCourse)->load('student_course'); 

       

        dispatch(new sendStudentsForEmailMessageByCourses($request->message , $getStudent))->onQueue('Emails');

        return back()->with(['info' => "تم ارسال  الرساله الي البريد الالكتروني لجميع الطلاب المشتركين بالدوره"]);
    }
}
