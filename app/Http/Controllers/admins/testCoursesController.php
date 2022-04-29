<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestCourse;
use App\Models\Question;
use App\Models\User;
class testCoursesController extends Controller
{
    public function getTestStudents()
    {
        $test = TestCourse::get()->load('student' , 'course');

     
        
        return view('dashboardAdmins.testCourses.test-course',compact('test'));
    }

    public function testFinishedStudent($idStudent , $idCourse)
    {
       
      $question =   Question::where('cource_id' , $idCourse)->get()->load('QuestionAnswers');
      $studentTest = TestCourse::where('student_id' ,$idStudent )->where('cource_id' , $idCourse)->first()->load('student' ,'course');
    
        
        return view('dashboardAdmins.testCourses.test-finished-student' ,compact('question' ,'studentTest'));
    }

    public function statusPrintCretif($id)
    {
      $status =  TestCourse::findOrFail($id);
      if( $status->allow_print === 0)
      {
         $status->allow_print = 1;
         $status->save();
      }else{
         $status->allow_print = 0;
         $status->save(); 
      }
      return back();
    }



  
}
