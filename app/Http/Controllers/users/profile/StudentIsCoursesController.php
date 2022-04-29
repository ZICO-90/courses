<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth ;
use App\Models\Interest;
class StudentIsCoursesController extends Controller
{

    public function subscribe()
    {

        $student = Auth::user();
       
        $interst_id =  $student->courses->map(function($query){
            return $query->interest_id ;
        })->toArray();

      $filter_finished_course =  $student->courses->map(function($query){
 
                  if($query->pivot->finished == 1 && $query->pivot->finished != 0)
                  {
                     
                      return strtoupper($query->id) ;
                  }
                  
                  })->reject(function ($query) {
                      return empty($query);
                  })->toArray();
        


      $filter_did_not_start_course =  $student->courses->map(function($query){
     
            if($query->pivot->finished == 0 && $query->is_activation == 0)
            {
               
                return strtoupper($query->id) ;
            }
            
           })->reject(function ($query) {
               return empty($query);
           })->toArray();


     $filter_start_course =  $student->courses->map(function($query){

            if($query->pivot->finished == 0 && $query->is_activation == 1)
            {
               
                return strtoupper($query->id) ;
            }
        
           })->reject(function ($query) {
               return empty($query);
           })->toArray();

 //->whereHas(['test_courses' => function($insideQuery) use($student ){ $insideQuery->has('student_id' , $student->id );}])
        $finished_course =     Interest::whereIn('id', $interst_id)->with(['courses'=> function($query)use( $filter_finished_course ,$student ){

            $query->whereIn('id' , $filter_finished_course  )->with(['test_coursesHasOne' => function($insideQuery)use($student){$insideQuery->where('student_id' , $student->id ); }]);
           }] )->get();


           $did_not_start_course =     Interest::whereIn('id', $interst_id)->with(['courses'=> function($query)use( $filter_did_not_start_course){

            $query->whereIn('id' , $filter_did_not_start_course   );
           }])->get();
      
           $start_course =     Interest::whereIn('id', $interst_id)->with(['courses'=> function($query)use( $filter_start_course){

            $query->whereIn('id' , $filter_start_course   );
           }])->get();
       //dd($finished_course , $did_not_start_course  ,$start_course );
      
        return view('sites.profile.courses.studentIs-courses', compact('finished_course' ,'did_not_start_course', 'start_course'));

    }
}
