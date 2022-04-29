<?php

namespace App\Http\Controllers\users\DisplayCourse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Course;
class courseInformationController extends Controller
{


public function intro($id)
{   



    try {
     

      $decryptedId =Crypt::decrypt($id);
      $intro_info_course =  Course::findOrFail($decryptedId)->load('lessons' , 'coures_instructor.biography' ,'Certificate' );
     

  
     return view('sites.coursesPages.course-intro',compact('intro_info_course'));

      } catch (DecryptException $e) 
      {
      abort(404,'Not Found');
      }

}

public function allCourse($id = null , Request  $request)
{
 

  $interest_list = \App\Models\Interest::pluck('name' , 'id');

  if(!empty($id))
  {

    try {

      $decryptedId =Crypt::decrypt($id);
      $all_course = Course::with('coures_instructor' , 'studen_course')->where('interest_id' ,$decryptedId)->paginate(6);
      } catch (DecryptException $e) 
      {
      abort(404,'Not Found');
      }

    
      return $this->Views($all_course  , $interest_list );
   
  }
  elseif(!empty($request))
  {
    //'title' ,"LIKE" , '%'. $request->search .'%' 
    $all_course = Course::with('coures_instructor' , 'studen_course')->where(function($search) use($request){
      $search->where('title' ,"LIKE" , $request->search .'%' )
      ->orWhere('title' ,"LIKE" , '%'. $request->search  )
      ->orWhere('title' ,"LIKE" , '%'. $request->search .'%') ;
    })->paginate(6)->appends(request()->query());
    
   
    return $this->Views($all_course  , $interest_list );
  }
  else
  {
   
     $all_course = Course::with('coures_instructor' , 'studen_course')->paginate(6); 
     return  $this->Views($all_course  , $interest_list );
  }

  
}

public function Views($all_course , $interest_list)
{
  return view('sites.coursesPages.all_courses',compact('all_course' , 'interest_list'));
}


public function searchAjax(Request  $request)
{


  $all_course = Course::with('coures_instructor' , 'studen_course')->where(function($search) use($request){
    $search->where('title' ,"LIKE" , $request->texetQuery .'%' )
    ->orWhere('title' ,"LIKE" , '%'. $request->texetQuery  )
    ->orWhere('title' ,"LIKE" , '%'. $request->texetQuery .'%') ;
  })->get();

 
  return json_encode($all_course );
}





}
