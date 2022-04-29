<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Course;
use App\Models\TestCourse;
use Auth;
use App\Models\UserCource;
class testCoursesController extends Controller
{
  public function testShow($id)
  {
    try {
        $id  =Crypt::decrypt($id);
       
        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }


        $getTest = Course::findOrFail($id)->load('questions');
        $getEndTestStudent = $getTest->test_courses->where('student_id' , Auth::user()->id)->first();
      // dd( $getTest ,$getEndTestStudent );
    return view('sites.coursesPages.test-show' ,compact('getTest' , 'getEndTestStudent'));
  }

  public function testFinished(Request $request ,$id)
  { 

  
    try {
        $id  =Crypt::decrypt($id);
       
        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }

        $getTest = Course::findOrFail($id)->load('questions');

        if(sizeof($request->k) != sizeof($getTest->questions) )
        {
          
           return back()->with( 'info' , "من فضل  اجب علي جميع الاسئلة")->withInput();
         
        }

        $countTrue = 0 ;
        $countFalse= 0;
   
      //48 , 49 , 55 , 60 , 60 , 66 , 72 , 75
     //   dd($countTrue , $countFalse ,  $getTest );
        foreach ($getTest->questions as  $question) {
          
            foreach ($question->QuestionAnswers as  $answer ) {
                if($request->k[$question->id] == $answer->id)
                {
                    if($answer->true_false === 1)
                    {
                        $countTrue++;
                       
                    }else{
                        $countFalse++;
                       
                    }
                }
            }
        }


       


    $getTest =    $getTest->test_courses()->create([
            'student_id' => Auth::user()->id,
            'true' =>$countTrue  ,
            'false' => $countFalse,
            'question' => sizeof($getTest->questions),
            'details_answer' =>   $request->k,

        ]);
        
     $finished_course =   UserCource::where('student_id' ,$getTest->student_id )->where('cource_id' , $getTest->cource_id)->first();
    
     $finished_course->finished = 1 ;
     $finished_course->save();
        return redirect()->back();
  
  }
}
