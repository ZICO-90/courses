<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\UserCource;
class instructorController extends Controller
{
    public function getInstructor()
    {
        $instructor = User::instructor()->get();
      //
        return view('dashboardAdmins.instructors.show-instructor' ,compact('instructor')) ;
    }

    public function stopInstructo($id)
    {
      $stop =  User::findOrFail($id) ;
     if( $stop->is_stop === 0)
     {
        $stop->is_stop = 1;
        $stop->save();
     }else{
        $stop->is_stop = 0;
        $stop->save(); 
     }
     return back();
     
    }

    public function courseInstructor($id)
    {
      $instructor =  User::findOrFail($id)->load('course_instructor' , 'course_instructor.studen_course' , 'biography') ;
   
    //dd($instructor);
   
     return view('dashboardAdmins.instructors.show-courses' ,compact('instructor')) ;
    }

    public function courseDetailsInstructor($id)
    {
      $course_instructor =  Course::findOrFail($id)->load('Certificate' , 'coures_instructor' , 'lessons') ;
   
    //dd($instructor);
   
     return view('dashboardAdmins.instructors.show-detalis-courses',compact('course_instructor')) ;
    }

    public function StudentSubscribers($id)
    {
     $subscribers =  UserCource::where('cource_id' ,$id)->get()->load('user_student' , 'user_studen_course') ;

   
   
     return view('dashboardAdmins.instructors.show-subscribers',compact('subscribers')) ;

    }

}
