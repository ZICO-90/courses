<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use PDF;
use App\Models\User;
use App\Models\Course;
use App\Models\TestCourse;
class certifPrintController extends Controller
{

public function certifPrintShow($id )
{

    
    try {
        $id = Crypt::decrypt($id);
    
        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }
    
   $info_student_test =  TestCourse::findOrFail($id)->load('student' , 'course.coures_instructor');

   $FormatDate =  \Carbon\Carbon::parse( strtotime($info_student_test->created_at) )->format('Y-m-d') ;
   
   $data = [
      
        'name_student' => $info_student_test->student->full_name ,
        'title_course' => $info_student_test->course->title ,
        'name_instructor' =>   $info_student_test->course->coures_instructor->full_name ,
        'date' => $FormatDate  ,
        'code' => $info_student_test->student->id .":". $info_student_test->course->id . ":".   $info_student_test->course->instructor_id,
   ];
  //dd($info_student_test ,   $FormatDate  , $data  );

   return view('sites.profile.certif_print_show' ,compact('data'));
}

    public function snappyBdf($id)
    {
    
        try {
            $id = Crypt::decrypt($id);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }
        
       $info_student_test =  TestCourse::findOrFail($id)->load('student' , 'course.coures_instructor');
    
       $FormatDate =  \Carbon\Carbon::parse( strtotime($info_student_test->created_at) )->format('Y-m-d') ;
       
       $data = [
          
            'name_student' => $info_student_test->student->full_name ,
            'title_course' => $info_student_test->course->title ,
            'name_instructor' =>   $info_student_test->course->coures_instructor->full_name ,
            'date' => $FormatDate  ,
            'code' => $info_student_test->student->id . ":".  $info_student_test->course->id . ":".  $info_student_test->course->instructor_id,
       ];
       if( $info_student_test->certif_receive  != 1)
       {
          $info_student_test->certif_receive = 1 ;
          $info_student_test->save();
         
       }
    
       
         $pdf = PDF::loadView('sites.profile.certif_print_snappy_pdf' ,compact('data'));
         return  $pdf->download($data['date'] . '_'. str_replace(' ', '', $data['name_student'] ) .'.pdf'); 
   
    }

 


public function CertifStudent ()
{
    $my_certf =  TestCourse::where('student_id' ,  auth()->guard('web')->user()->id)->get()->load('student' , 'course.coures_instructor');
   
    return view('sites.profile.courses.my_certf' ,compact('my_certf'));
}

public function CertifRequset($id)
{
    try {
        $id = Crypt::decrypt($id);
    
        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }

    $info_student_test =  TestCourse::findOrFail($id) ;
    
    $massge = "قد طلبت الشهاده مسبقا" ;
    if($info_student_test->certif_request != 1)
    { 
        $info_student_test->certif_request = 1;
        $info_student_test->save();
        $massge = "لقد تم ارساله تنويه الي الادارة  لسماح لك بطباعه الشهاده";
    }
   
    return back()->with('info' ,  $massge );
}

/********************************************/
public function snappyBdf_test($id)
{

    try {
        $id = Crypt::decrypt($id);
    
        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }
    
   $info_student_test =  TestCourse::findOrFail($id)->load('student' , 'course.coures_instructor');

   $FormatDate =  \Carbon\Carbon::parse( strtotime($info_student_test->created_at) )->format('Y-m-d') ;
   
   $data = [
      
        'name_student' => $info_student_test->student->full_name ,
        'title_course' => $info_student_test->course->title ,
        'name_instructor' =>   $info_student_test->course->coures_instructor->full_name ,
        'date' => $FormatDate  ,
        'code' => $info_student_test->student->id . ":".  $info_student_test->course->id . ":".  $info_student_test->course->instructor_id,
   ];

   
     $pdf = PDF::loadView('sites.snappy_print_test' ,compact('data'));

   
     return  $pdf->stream($data['date'] . '_'. str_replace(' ', '', $data['name_student'] ) .'.pdf'); 

}

}
