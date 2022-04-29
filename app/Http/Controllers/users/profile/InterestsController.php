<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interest;
use App\Http\Traits\UsersTrait;
use App\Models\User;
class InterestsController extends Controller
{

    use  UsersTrait ;
   
    private $UserModel ;

    public function __construct(User $user_Model )
    {
        $this->UserModel = $user_Model;
        
    }
    public function show()
    {
        $user_interests = $this->get_user_by_id(auth()->user()->id)->Interests()->get();
        $all_interest = Interest::get();
        return view('sites.profile.interests.show_detalis_interest',compact('all_interest' ,'user_interests'));
    }

    public function update(Request $request , $id)
    {


       

         $user_info = $this->get_user_by_id($id); 
         $message = null ;
         if(!$request->has('is_view_gender'))
         {
             if(sizeof((array)$user_info->is_view) > 0)
             $message = "مفضلك يجب عليك تحديد انواع الدورات ذكر او إناث او كلاهما ولا يمكن التراجع عنها" ;
                else
             $message =  'يجب عليك تحديد انوع الدورات' ;
            return back()->with(['error' =>  $message ]);
         }
        
         $is_sync =    $user_info->Interests()->syncWithPivotValues($request->interest_id , ['is_work' => $user_info->is_work] );
         
         
         if( (bool) sizeof($is_sync['attached']) || (bool) sizeof($is_sync['detached']) )
         {
            $message = " تمت معالجه اهتماماتك بنجاح ";

         }

         
      
        if($request->has('is_view_gender'))
        {
            
              if(sizeof(array_intersect( $request->is_view_gender ,(array)$user_info->is_view )) != 2)
              {
               
               $user_info->is_view = $request->is_view_gender ;
               $user_info->save();
               if(!empty($message))
                   $message .=    " وتمت تحديد الدورات التي تفضلها " ;
               else
               $message =  "تمت تحديد انواع الدورات التي تفضلها" ;
              }       
        }
       
        if(empty($message))
        $message =  "من فضلك اختار البيانات المطلوبة ليتم معالجتها" ;

        return back()->with(['success' => $message ]);
    }
}
