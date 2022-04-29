<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class HomeController extends Controller
{
    public function home()
    {
  
    
                $lasts_course = Course::with('coures_instructor' , 'studen_course')->skip(0)->take(12)->latest()->get(); 
         
              //  dd( $lasts_course);

            /* 
             $arra = Auth::user();
                
                $filter_id = $arra->Interests()->get(['interest_id'])->map(function($item){
            
                   return $item->interest_id ;
                })->toArray();
            
               $Collction_filter_course =  Course::whereJsonContains( 'is_subscribe' , strval($arra->gender) )->whereIn('interest_id' , $filter_id)->get();
            */

          return  $this->Views($lasts_course);
    }


    public function homeSearsh(Request $request)
    {
      if($request->has('searsh_advanced'))
      {     
     
             $resultInstructor =  \App\Models\User::where('is_work' , 1)->orWhere('is_work' , 3)->where(function($search_name) use($request){
               $search_name->Where('username' ,"LIKE" , $request->searsh_instructor .'%' )
               ->orWhere('username' ,"LIKE" , '%'. $request->searsh_instructor  )
               ->orWhere('username' ,"LIKE" , '%'. $request->searsh_instructor .'%') ;
              
             })->get(['id']);
         
             $getInstructorNameById = $resultInstructor->map(function($query){
               return $query->id;
             })->toArray();
         
             //------------------------------------------------------------------------------------
         
             $resultInterest =   \App\Models\Interest::where(function($search_name) use($request){
               $search_name->Where('name' ,"LIKE" , $request->type_course .'%' )
               ->orWhere('name' ,"LIKE" , '%'. $request->type_course  )
               ->orWhere('name' ,"LIKE" , '%'. $request->type_course .'%') ;
              
             })->get(['id']);
         
         
             $getInterestNameById = $resultInterest->map(function($query){
               return $query->id;
             })->toArray();
     
             $lasts_course = Course::with('coures_instructor' , 'studen_course')
                     ->whereIn('instructor_id' ,  $getInstructorNameById)
                     ->whereIn('interest_id' ,$getInterestNameById)
                     ->whereBetween('course_price' , $request->has('free') ? [0 , 0 ]: [$request->price_to , $request->price_form ])
                     ->where('case_payment_course' , $request->has('free') ? 0:1 )
                     
                     ->where(function($query)use($request){
                     $query->Where('title' ,"LIKE" ,  $request->name_course . '%') 
                     ->orWhere('title' ,"LIKE" , '%'. $request->name_course . '%'  )
                     ->orWhere('title' ,"LIKE" , '%'. $request->name_course ); }) ->get();
     
             
             return  $this->Views($lasts_course)->withInput($request);

        }else{
          
          $lasts_course = Course::with('coures_instructor' , 'studen_course')->where(function($query)use($request){
            $query->where('title' ,"LIKE" ,  $request->searsh . '%') 
            ->orWhere('title' ,"LIKE" , '%'. $request->searsh . '%'  )
            ->orWhere('title' ,"LIKE" , '%'. $request->searsh ); }) ->get();

            return  $this->Views($lasts_course);
        }

    }

    public function Views($lasts_course)
    {
         return view('sites.layout-site',compact('lasts_course'));
    }


    public function searchAjax(Request $request)
    {

     

      $lasts_course = Course::with('coures_instructor' , 'studen_course')->where(function($query)use($request){
        $query->where('title' ,"LIKE" ,  $request->texetQuery . '%') 
        ->orWhere('title' ,"LIKE" , '%'. $request->texetQuery . '%'  )
        ->orWhere('title' ,"LIKE" , '%'. $request->texetQuery ); }) ->get();




      return json_encode($lasts_course );
}

}
