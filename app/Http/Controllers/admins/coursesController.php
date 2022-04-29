<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
class coursesController extends Controller
{
  public function getCourses()
  {
        $courses  =  Course::get()->load('coures_interest' , 'coures_instructor' , 'studen_course');
      
        return view('dashboardAdmins.courses.courses-show' ,compact('courses'));
  }

  public function stutusCourse($id)
  {
        $courses  =  Course::findOrFail($id);

        if($courses->is_activation === 1)
        {
            $courses->is_activation =0;
            $courses->save();
        }else{
            $courses->is_activation =1;
            $courses->save();
        }

      
        return back();
  }
}
