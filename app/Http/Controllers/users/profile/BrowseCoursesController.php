<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;
use Auth;
use App\Models\Interest;
class BrowseCoursesController extends Controller
{


    public function browses()
    {

             $student = Auth::user();

             if( sizeof( (array) $student->is_view ) === 0)
             return redirect()->route('profile.interest.show')->with(['info' =>  "جيب عليك تحديد نوع الدورات التي تشاهده ذكر او انثي قد تم تحويلك الي هذه الصفحة"]);

             if(sizeof($student->Interests()->get()) === 0)
             return redirect()->route('profile.interest.show')->with(['info' =>  "ليس لديك اهتمامات !! تم تحويلك الي صفحة اهتماماتك"]);


             $filter_instructor_id  =     $student->instructor()->whereIn('gender' ,array_map('intval', $student->is_view )  )->get()->map(function($item){
            
               return  intval($item->id) ;
                   })->toArray();


            $filter_by_cource_Notactive = $student->Interests()->with(['courses'=> function($query) use($student,$filter_instructor_id ){

               return $query->whereIn('instructor_id' , $filter_instructor_id )->where('is_activation' , 0)->whereJsonContains( 'is_subscribe' , strval($student->gender)  ) ;  ;

             }])->get();

             $filter_by_cource_active = $student->Interests()->with(['courses'=> function($query) use($student,$filter_instructor_id ){

               return $query->whereIn('instructor_id' , $filter_instructor_id )->where('is_activation' , 1)->whereJsonContains( 'is_subscribe' , strval($student->gender)  ) ;

             }])->get();

             
               $isSubscribes =  $student->courses()->get();

           //   dd(  $filter_by_cource_Notactive ,  $filter_by_cource_active );
              /// dd(  $Collction_filter_course_end ,  $Collction_filter_course_start );
            

              return view('sites.profile.courses.browses_courses' ,compact('filter_by_cource_active' , 'filter_by_cource_Notactive' , 'isSubscribes' ));

    }
}
