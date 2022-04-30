<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\courses\AddCoursesRequest;
use App\Http\Requests\courses\UpdateCourseRequest;
use App\Http\Requests\courses\UpdateOrCreateCertificateRequest;
use App\Http\Traits\ImagesTrait;
use App\Http\Traits\UsersTrait;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Certificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Auth;
use DateInterval;
use Owenoj\LaravelGetId3\GetId3;


class CoursesController extends Controller
{
    use  UsersTrait ;
    use ImagesTrait ;
    
   
    private $UserModel ;

    public function __construct(User $user_Model )
    {
        $this->UserModel = $user_Model; 
    }

    public function drop_down_course($corses)
    {
       return $corses->course_instructor()->get()->pluck('title','title')->toArray();

    }

    public function drop_down_interests($interests)
    {

       return $interests->Interests()->get()->pluck('name','id')->toArray();

    }
    

    public function addCourseShow()
    {
        $instructor_id = auth()->guard('web')->user()->id;
        $auth_info_instructor = $this->get_user_by_id($instructor_id);

        $course_dropDownList = null;
        $interest_dropDownList = null;
        if($auth_info_instructor->is_work != 2)
        {
       
            $course_dropDownList = $this->drop_down_course($auth_info_instructor);


            if((bool) sizeof( $course_dropDownList ))
            {
                $course_dropDownList = [' '=> "هل تريد تحديد دورات اخري متعلقة بهذه الدوره"] + $course_dropDownList;
               
            }else{
                $course_dropDownList = [' '=> "لا توجد لديك دورات سابقة"] ;
            }
           
            $interest_dropDownList =  $this->drop_down_interests($auth_info_instructor);
          
            if( (bool) sizeof($interest_dropDownList) === false )
            {
            
                $message = " اهلا وسهلا بك " . $auth_info_instructor->username  . " ليس لديك اهتمامات مسجله مسبقا  قد تم تحويلك الي صفحة اهتماماتك ";
                return redirect()->route('profile.interest.show')->with(['info' =>  $message]);
            }
          
            $interest_dropDownList = [' ' => 'اختر..'] +  $interest_dropDownList ;
            
          
        }else{
            Auth::guard('web')->logout($auth_info_instructor);
            return redirect()->route('homepage');
        }
        
       
        return view('sites..profile.courses.add_course' , compact('course_dropDownList' ,'interest_dropDownList') );
    }

    public function CourseCreate(AddCoursesRequest $request)
    {
           
     
        if( $request->has('up_video') )
        {
            $file =$request->file('file');
            $filename = time().hash('sha256' , Str::random(120)) . '.' . $file->getClientOriginalExtension();
            $is_path_public = 'site/assets/uploads/courses/';
            $this->uploadImage($file ,$filename,$is_path_public);
           
            $request->url = $is_path_public . $filename ;
          
        }




        $auth_check_instructor_id =  auth()->guard('web')->user()->id ;
        $user_info = $this->get_user_by_id($auth_check_instructor_id);

       //رقم 2 بيكون طالب رقم 1 معلم رقم 3  كلاهما
        if($user_info->is_work == 2) #--begin if  لا يمكن لطالب انشاء دوره مطلقا  إلا اذ كان كلاهما طالب ومدرس
        {
            Auth::guard('web')->logout();

      
    
            return redirect('/');
        }#--end if


            #-- begin try
            try{
                DB::beginTransaction();

                $inser_rules_course = [
                    'instructor_id' =>$user_info->id ,
                    'interest_id' => $request->interest_id ,
                    'title' => $request->title,
                    'details' => $request->details,
                    'course_price' => $request->course_price,
                    'case_payment_course' => $request->case_payment_course ,
                    'url' => $request->url ,
                    'url_type' => $request->has('up_video') ? 1 : 0,
                    'start_date' =>  $request->start_date ,
                    'end_date' => $request->end_date,
                    'is_subscribe' =>$request->is_subscribe,
                    'previous_requirement' =>  empty($request->previous_requirement) ? (array)$request->previous_requirement : $request->previous_requirement,
                ];
        
                   if($request->case_payment_course == 0 )
                    unset($inser_rules_course['course_price']) ;
               
                $get_course = Course::create($inser_rules_course);


                if($request->has('add_cert')) #-- begin if add_cert
                {
                    /*
                    if($request->case_payment_ertifi == 0)                       
                        $request->certifi_price = 0;
                    */
                    $insert_certificate_rules = [
                        'name' => $request->name ,
                        'reference_certif' => $request->reference_certif ,
                        'certifi_price' => $request->certifi_price,
                        'case_payment' => $request->case_payment_ertifi,
                        'cource_id' => $get_course->id,

                    ];

                         if($request->case_payment_ertifi == 0)                       
                         unset($insert_certificate_rules['certifi_price']);
     
                         Certificate::create($insert_certificate_rules);

                } #-- end if add_cert

                DB::commit();

                $message  =  " تمت اضافة الدورة " . $inser_rules_course['title']  . " بنجاح "  ;
                return redirect()->route('profile.course.details')->with(['info' =>  $message ]);
            }catch(\Exception $ex)
            {

                if( $request->has('up_video') )
                {
                \Illuminate\Support\Facades\File::delete( $request->url) ;
                }
                $message = "قد حدث مشكلة ما برجاء المحاوله في وقت لاحق"  ;
               
                DB::rollback();
                return redirect()->back()->with(['info' =>  $message]);


            } #-- end  try



  


    } #- end public function CourseCreate



    public function details()
    {

        $auth_check_instructor_id =  auth()->guard('web')->user()->id ;
        $instructor_info_course = $this->get_user_by_id($auth_check_instructor_id)->load('course_instructor.studen_course','course_instructor.coures_interest' ,  'course_instructor.Certificate' ,'course_instructor.lessons' ,'course_instructor.questions.QuestionAnswers');

      // dd($instructor_info_course );
  
       //رقم 2 بيكون طالب رقم 1 معلم رقم 3  كلاهما
        if($instructor_info_course->is_work == 2) #--begin if  لا يمكن لطالب انشاء دوره مطلقا  إلا اذ كان كلاهما طالب ومدرس
        {
            Auth::guard('web')->logout();

        
    
            return redirect('/')->with(['error' => "لا تمتلك الصلاحية لمتابعه هذه القسم تم تسجيل خروجك"]);
        }#--end if
        $course_dropDownList = $this->drop_down_course($instructor_info_course);
        $interest_dropDownList = [' ' => 'اختر..'] + $this->drop_down_interests($instructor_info_course);
     

        return view('sites..profile.courses.detials_course',compact('instructor_info_course' ,'course_dropDownList','interest_dropDownList'));  

    }
    public function updateCourese(UpdateCourseRequest $request ,$id)
    {
     
       $update_course =  Course::findOrFail($id) ;

       $file = null ;
       if( $request->has('up_video_'.$id) )
       {
          
           if($request->has('file_'.$id))
           {
            $file =$request->file('file_'.$id);
          
            $filename = time().hash('sha256' , Str::random(120)) . '.' . $file->getClientOriginalExtension();
          
            $is_path_public = 'site/assets/uploads/courses/';
             
            $this->uploadImage($file ,$filename,$is_path_public , $old_path =  $update_course->url);
           
            $update_course->url = $is_path_public . $filename ;
            $update_course->url_type = 1 ;
           }
           
         
       }

     
       $inser_rules_course = [
        'interest_id' => $request['interest_id_'.$id] ,
        'title' => $request['title_'.$id],
        'details' =>$request['details_'.$id],
        'course_price' => $request['course_price_'.$id],
        'case_payment_course' => $request['case_payment_course_'.$id],
        'start_date' => $request['start_date_'.$id] ,
         'end_date' =>  $request['end_date_'.$id] ,
        'is_subscribe' => $request['is_subscribe_'.$id],
        'previous_requirement' =>  empty($request['previous_requirement_'.$id]) ? (array)$request['previous_requirement_'.$id]: $request['previous_requirement_'.$id],
    ];
    
       if($request['case_payment_course_'.$id] == 0 )
        $inser_rules_course['course_price'] = 0 ;

    

        if(! $request->has('up_video_'.$id) )
        {
           
            if(empty($request['url_'.$id] ))
            {
                return back()->with(['info' => "من فضل ادخل رابط فيديو اليوتيوب الخارجي  ولتراجع  قم بإعاده تحميل الصفحة"]);
            }else{
                \Illuminate\Support\Facades\File::delete((public_path( $update_course->url)));
            }

            $update_course->url = $request['url_'.$id]  ;
            $update_course->url_type = 0;
        }
             
        $update_course->update($inser_rules_course);
      
        $message = " تم تعديل دورة" . $update_course->title . " بنجاح " ;
        return back()->with(['info' => $message ]);     
       
    }
//implode(null,$arr)==null
   public function updateOrCreateCertificate(UpdateOrCreateCertificateRequest $request, $certifi)
   {
       
      

       $encryptedId_course = \Illuminate\Support\Facades\Crypt::decrypt($request->validation_certifi_id);
        
      
       if($request->isMethod('post'))
       {

                 $insert_certificate_rules = [
                                      'name' => $request['name_'.$encryptedId_course] ,
                                      'reference_certif' => $request['reference_certif_'.$encryptedId_course] ,
                                      'certifi_price' => $request['certifi_price_'.$encryptedId_course],
                                      'case_payment' => $request['case_payment_ertifi_'.$encryptedId_course],
                                      'cource_id' => $encryptedId_course, // this course id
                                     ];
         
                         if($insert_certificate_rules['case_payment'] == 0)                       
                             unset($insert_certificate_rules['certifi_price']);
            
                            

                         if($insert_certificate_rules['case_payment'] == 1)
                         {
                            if(( (int) $insert_certificate_rules['certifi_price'] * 1 ) == 0)
                                return back()->with(['info' => 'من فضل ادخل مبلغ الشهاده بشكل صحيح' ])->withInput()->withErrors(['certifi_price_'.$encryptedId_course => 'سعر الشهاده غير حقيقي']);  
                         }
                             

                                
         
                           Certificate::create($insert_certificate_rules); 
                           return back()->with(['info' => 'تمت اضافة الشهادة بنجاح الي الدورة' ]);   
     

       } elseif($request->isMethod('put')){

       
                $update =   Certificate::findOrFail($certifi);

                $insert_certificate_rules = [
                                   'name' => $request['name_'.$encryptedId_course] ,
                                   'reference_certif' => $request['reference_certif_'.$encryptedId_course] ,
                                   'certifi_price' => $request['certifi_price_'.$encryptedId_course],
                                   'case_payment' => $request['case_payment_ertifi_'.$encryptedId_course],
                                 ];
  
                                
                      if($insert_certificate_rules['case_payment'] == 1)
                      {
                          if($insert_certificate_rules['certifi_price'] * 1 == 0)
                          return back()->with(['info' => 'من فضل ادخل مبلغ الشهاده بشكل صحيح' ])->withInput()->withErrors(['certifi_price_'.$encryptedId_course => 'سعر الشهاده غير حقيقي']);    
                      }
                      else
                        $insert_certificate_rules['certifi_price']  = 0 ;


                        $update->update($insert_certificate_rules);
                        return back()->with(['info' => 'تم تعديل الشهاده بنجاح' ]); 
                      
        
       }else
        return  abort(404,'Not Found');


   }


   public function delete($id)
    {
     
       
        $course = Course::findOrFail($id);
   
        if($course ->url_type === 1)
        {
            \Illuminate\Support\Facades\File::delete($course ->url);
        }

        $Lesson = Lesson::where( 'cource_id' ,$course->id)->get();
      
        if( sizeof($Lesson) > 0 )
        {

               foreach ($Lesson as  $value) {
                  
                   if($value->url_type === 1)
                   {
                       \Illuminate\Support\Facades\File::delete($value ->url_video);
                   }
                 
               }
       }

        $course->delete();
        return redirect()->back()->with(['info' =>  "تم حذف الدورة بنجاح" ]);

    }


   
}
