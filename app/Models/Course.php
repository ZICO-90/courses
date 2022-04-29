<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Crypt;
class Course extends Model
{
    
 
    use HasFactory;
 
    protected $fillable = [
        'instructor_id',
        'interest_id',
        'title',
        'details',
        'course_price',
        'case_payment_course',
        'is_subscribe',
        'url',
        'url_type',
        'start_date',
        'end_date',
        'previous_requirement',
        'is_activation',
        
    ];


    protected $hidden = [
        'is_activation',
    ];

    protected $casts = [
        
        'previous_requirement' => 'json',
        'is_subscribe' => 'json',
    ];
    protected $appends = ['youtube_id' ,'encrypt_id_ajax', 'star' , 'degree'];

    public function coures_interest()
    {
        return $this->belongsto(Interest::class,'interest_id' ,'id');
    }

    public function coures_instructor()
    {
        return $this->belongsto(User::class,'instructor_id' ,'id'); 
    }

    public function Certificate()
    {
        return $this->hasOne(Certificate::class ,'cource_id','id');
    }

    public function lessons()
    {
      return $this->hasMany(Lesson::class ,'cource_id' ,'id')->orderBy('sort_display_video' ,'asc');
    }

    public function questions()
    {
      return $this->hasMany(Question::class ,'cource_id' ,'id')->with('QuestionAnswers');
    }


    public function studen_course()
    {
      return $this->hasMany(UserCource::class ,'cource_id' ,'id');
    }


    public function student_course() #-- subscribue users
    {
    
      return $this->belongstoMany(User::class ,'user_cources' , 'cource_id' , 'student_id')->withPivot('is_work' ,'withdraw' ,'finished')->withTimestamps();
    }
    #-----------------------------------------------------------------------#
   
    public function getYoutubeIdAttribute()
    {
        if($this->url_type == 0)
        {

           /*
               My code this is working 
               parse_str(parse_url($this->url,PHP_URL_QUERY),$arr);
                $video_id=$arr['v']; 
           */
            
            $positionStart = strrpos($this->url, 'v=')+2;
            $positionEnd = strrpos($this->url, '&' , $positionStart);
            $youtube_id = substr( $this->url , $positionStart , ( strlen($this->url) - $positionEnd) );
            
            return   $youtube_id ;
        }
    }

    public function lessone_course()
    {
        return $this->hasMany(StudentLessonCource::class,'cource_id','id');
    }
    



    public function test_courses()
    {
      return $this->hasMany(TestCourse::class ,'cource_id' ,'id');
    }


    public function test_coursesHasOne()
    {
      return $this->hasOne(TestCourse::class ,'cource_id' ,'id');
    }

   

    public function getEncryptIdAjaxAttribute()
    {
      
      
            return   $id_ajax =  Crypt::encrypt($this->id) ;
        
    }


    public function ratings()
    {
      return $this->hasMany(Rating::class ,'cource_id' ,'id');
    }

  
    public function getStarAttribute()
    {

      if( $this->ratings->count()  > 0)
      {

    
      $star_1  =    $this->ratings->Where('star', '=', 1)->count() ;
      $star_2  =    $this->ratings->Where('star', '=', 2)->count() ;
      $star_3  =    $this->ratings->Where('star', '=', 3)->count() ;
      $star_4  =    $this->ratings->Where('star', '=', 4)->count() ;
      $start_5 =    $this->ratings->Where('star', '=', 5)->count();
     
      $total_people =$this->ratings->count();
      
     // 5 *  $start_5  + 4 * $star_4 + 3* $star_3 + 2 * $star_2  + 1* $star_1 / 5   >> if i want  percentage degree
     
      $star_avg = 5 *  $start_5  + 4 * $star_4 + 3* $star_3 + 2 * $star_2  + 1* $star_1 ;  
     
     
        
      return    intval( ceil($star_avg / $total_people))  ;
    }else{
      return 0;
    }
    }


    public function getDegreeAttribute()
    {

      if( $this->ratings->count()  > 0)
      {

    
      $star_1  =    $this->ratings->Where('star', '=', 1)->count() ;
      $star_2  =    $this->ratings->Where('star', '=', 2)->count() ;
      $star_3  =    $this->ratings->Where('star', '=', 3)->count() ;
      $star_4  =    $this->ratings->Where('star', '=', 4)->count() ;
      $start_5 =    $this->ratings->Where('star', '=', 5)->count();
     
     
      
     //  percentage 
     
      $star_avg = 5 *  $start_5  + 4 * $star_4 + 3* $star_3 + 2 * $star_2  + 1* $star_1  / 5;  
     
      if($star_avg >= 1 &&  $star_avg <= 30 )
      return "ضعيف" ;
      elseif($star_avg >= 30 &&  $star_avg <= 50 )
      return "مقبول" ;
      elseif($star_avg >= 50 &&  $star_avg <= 60 )
      return "جيد" ;
      elseif($star_avg >= 60 &&  $star_avg <= 70 )
      return "جيد جدا" ;
      elseif($star_avg >= 70 &&  $star_avg <= 80 )
      return "ممتاز" ;
      elseif($star_avg >= 80 &&  $star_avg <= 90 )
      return "ممتاز جدا" ;
      elseif($star_avg >= 90 &&  $star_avg <= 100 )
      return "ممتاز جدا جدا" ;
      elseif( $star_avg >= 100 )
      return "سوبر ممتاز" ;
     
    }else{
      return 'لا يوجد تقيم';
    }
    
    }
 
}
