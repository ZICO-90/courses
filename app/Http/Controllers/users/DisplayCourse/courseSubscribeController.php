<?php

namespace App\Http\Controllers\users\DisplayCourse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Rating;
use App\Models\StudentLessonCource;

use DateInterval;
use Alaouy\Youtube\Facades\Youtube;

use Auth;
class courseSubscribeController extends Controller
{
    public function show($id)
    {   
      /*
      ['test_courses' => function($query){
        $query->where('student_id' , 1 );
      }]
      */
          try {
            $user = Auth::guard('web')->user()->id ;
            $decryptedId =Crypt::decrypt($id);
            $show_info_course =  Course::with(['test_courses.student.test_courses' => function($query)use($user  ,  $decryptedId){
                $query->where('student_id' , $user )->where('cource_id' ,  $decryptedId)->first();
            }] )->with('lessons' , 'coures_instructor.biography' ,'Certificate' ,'lessone_course' )->findOrFail($decryptedId);

           
            $OpenTest = StudentLessonCource::where('student_id',$user)->where('cource_id' , $show_info_course->id )->get();
      
           return view('sites.coursesPages.course-show',compact('show_info_course' ,'OpenTest'));
      
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }

   }

   public function individualShwo($id)
   {

                try {
                  $id = Crypt::decrypt($id);
                  
                } catch (DecryptException $e) 
                {
                abort(404,'Not Found');
                }

         $thisLesson = Lesson::findOrFail($id)->load('comments'); //lessons
        //dd($thisLesson);
         $allLessons =  Course::findOrFail($thisLesson->cource_id )->load('lessons' , 'lessons.student_lessone_course');

       
       

       

    return view('sites.coursesPages.course-individual' , compact('thisLesson' , 'allLessons'  ));
   }


  public function endLeeeson(Request $request)
  {


    try {
      $id_student = Crypt::decrypt($request->studentID);
      $id_lesson = Crypt::decrypt($request->lessonID);
      $id_cource = Crypt::decrypt($request->courceID);
      
    } catch (DecryptException $e) 
    {
    abort(404,'Not Found');
    }

  $Check =   StudentLessonCource::create([
      'lesson_id' => $id_lesson ,
      'student_id' => $id_student,
      'cource_id' => $id_cource ,
    ]);

    if(!empty($Check))
    return redirect()->back();
    else
    return redirect()->back()->with(['error' =>  "يوجد مشكله ماء برجاء ارسال الدعم الفني"]);



   
  }



  public function courseFree(Request $request)
  {

    try {
      $student_id  =Crypt::decrypt($request->student);
     
      $course_id  =Crypt::decrypt($request->course);
  
      } catch (DecryptException $e) 
      {
      abort(404,'Not Found');
      }
    
   


    \App\Models\UserCource::create([
      'student_id' => $student_id  ,
      'cource_id' =>  $course_id ,
      'is_work' => auth()->guard('web')->user()->is_work,
     
     ]);

     return redirect()->back();
  }
  
  public function rating(Request $request)
  {

    try {
      $idCourse = Crypt::decrypt($request->idCourse);
     
      } catch (DecryptException $e) 
      {
      abort(404,'Not Found');
      }
/*
     
      for($i = 0 ; $i < 20000 ;$i++ )
      {
        Rating::create([
          'student_id' => 1,
          'cource_id' => 4,
          'star' => 5,
        ]);
      }
*/
     
      Rating::create([
        'student_id' => Auth::guard('web')->user()->id,
        'cource_id' => $idCourse ,
        'star' => $request->ratingRadio,
      ]);
     

      return redirect()->back();

  }



  public function test()// مجرد اختبار الكود فقط ليس مستخدم في المشروع
  {
    $test =  Course::findOrFail(4)->load('ratings');
    /*
    $star_1 = 1 *  $test->ratings->Where('star', '=', 1)->count() ;
    $star_2 = 2 *  $test->ratings->Where('star', '=', 2)->count() ;
    $star_3 = 3 *   $test->ratings->Where('star', '=', 3)->count() ;
    $star_4 = 4 *   $test->ratings->Where('star', '=', 4)->count() ;
    $start_5 = 5 *  $test->ratings->Where('star', '=', 5)->count();
    
   $tt = $test->ratings->Where('star', '=', 1)->sum('star') + $test->ratings->Where('star', '=', 2)->sum('star') +  $test->ratings->Where('star', '=', 3)->sum('star') + $test->ratings->Where('star', '=', 4)->sum('star') + $test->ratings->Where('star', '=', 5)->sum('star');

    $result = ($star_1 +  $star_2  + $star_3 +   $star_4 + $start_5)  ;


    $_1 = 1 * 80  ;
    $_2 = 2 * 80 ;
    $_3 = 3 * 60  ;
    $_4 = 4 * 40   ;
    $_5 = 5 * 80 ;

    $test =  ($_1 + $_2 +  $_3 + $_4 + $_5)  / 320 ;

   
    $yy = 5*60 + 25*4 + 20*3 + 15*2 + 80*1 ;
    $Responsetotal= 50 + 25 + 20 + 15 + 10 ;
*/

    $star_1 =   $test->ratings->Where('star', '=', 1)->get()->delete() ;
    $star_2 =   $test->ratings->Where('star', '=', 2)->get()->delete() ;
    $star_3 =   $test->ratings->Where('star', '=', 3)->get()->delete() ;
    $star_4 =    $test->ratings->Where('star', '=', 4)->get()->delete() ;
    $start_5 =   $test->ratings->Where('star', '=', 5)->get()->delete();

    $totals = $test->ratings->count();
    $ff = 5 *  $start_5  + 4 * $star_4 + 3* $star_3 + 2 * $star_2  + 1* $star_1 ;
    $UU = $start_5 + $star_4  + $star_3 + $star_2 + $star_1;
   
    dd($ff /  $UU , $ff / 5  * $totals , $ff / $totals  , $totals  , $test->ratings->Where('star', '=', 2)->count() , ceil($ff /  $UU ));
  }

}
