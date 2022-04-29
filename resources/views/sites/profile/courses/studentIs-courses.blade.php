
@extends('sites.layout-site')

@section('title')
تصفح الدورات
@endsection
@section('css')
<style>

.package-item-header {
  margin-top: 20px;
  margin-left: 0;
  width: 200;
  background-color: #ffffff;
  text-align: center;
  font-size: 24px;
  position: relative;
  padding: 20px;
  overflow: visible;
  float: left;
}

.package_stamp {
  height: 60px;
  width: 60px;
  background: url('https://i.imgur.com/bPR0GVD.png') 50px no-repeat;
  background-position: center;
  position: absolute;
  top: -20px;
  right: -20px;
  background-size: cover;
  z-index: 1;
}

</style>
@endsection

@section('contacts')

<div class="profile-content empty-course">
    <div class="container">
          @include('sites.includes.alerts.success')
          @include('sites.includes.alerts.errors')
          @include('sites.includes.alerts.info')
          @include('sites..profile.layout_ontant')
          <div class="left_tap-box col-md-9 col-xs-12 pull-left">
         
                <div class="left_box-inner">
                <!-- Tab panes -->
                      <div class="tab-content">
<!----------------------------------------------------->
<div role="tabpanel" class="tab-pane fade active in" id="my_courses">
    <div class="home-head">
        <h1>
            <i class="fa fa-folder-open-o"></i>
            دوراتي
        </h1>
    </div>
    <!-- /.home-head -->
    <div class="home-content pass-content col-xs-12">
        <div class="home_data col-xs-12 pull-right text-right">
            <div class="my_courses-container">
                <div>
                    @php
                    $months = [
                                'January' => "يناير" ,
                                'February' => "فبراير",
                                
                                'March' => "مارس" ,
                                'April' => "أبريل",
                                
                                'May' => "مايو" ,
                                'June' => "يونيو",
                                
                                'July' => "يوليو" ,
                                'August' => "أغسطس",
                                
                                'September' => "سبتمبر" ,
                                'October' => "أكتوبر",
                                
                                'November' => "نوفمبر" ,
                                'December' => "ديسمبر",
                                
                                
                                ];
                        @endphp

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#currentmy" aria-controls="current" role="tab" data-toggle="tab" data-original-title="" title="" aria-expanded="true">الدورات الحالية</a></li>
                        <li role="presentation"><a href="#commingmy" aria-controls="comming" role="tab" data-toggle="tab" data-original-title="" title="" aria-expanded="true">الدورات القادمة</a></li>
                        <li role="presentation"><a href="#finishedmy" aria-controls="comming" role="tab" data-toggle="tab" data-original-title="" title="" aria-expanded="true">الدورات المنتهية</a></li>
                    </ul>
                   
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="currentmy">
                          
                            @if( isset($start_course) && sizeof($start_course) > 0)
                        
                            @php
                            $if_count_start = 0 ;
                            $statusCount_start = 0 ;
                            $numItems_start = count($start_course);
                            @endphp
                            @foreach ($start_course as $item)

                       



                            @if(sizeof($item->courses) > 0 )
                       
                            <div class="type col-xs-12">
                                <div class="filtered-head text-right">
                                    <h1>
                                    <i class="fa fa-tags"></i>
                                    {{$item->name}}  
                                     </h1>
                                </div>
                                <!-- /.filtered-head -->
                                @foreach ($item->courses as $course)
                               
                                <div class="card col-md-6 col-xs-12 pull-right">

                                    <div class="card-inner">
                                       
                                        <span class="corse-type">{{$course->coures_interest->name}}</span>
                                        <div class="card-img">
                                          
                                            <img src="/site/assets/images/b3.jpg" alt="" class="img-responsive">
                                            <div class="lessons-number text-center">
                                               
                                                <h1>
                                               
                                                @if($course->case_payment_course === 1)
                                                <i class="fa fa-play-circle"></i>
                                                {{$course->course_price}}
                                                @else
                                                <i class="fa fa-play-circle"></i>
                                                    مجاني
                                                @endif
                                            </h1>
                                            </div>
                                            <!-- /.lessons-number -->
                                        </div>
                                        <!-- /.card-img -->
                                        <div class="card-data">
                                            <div class="course_name text-right">
                                                <h1>
                                                    <a href="{{route('courses.intro' ,Crypt::encrypt($course->id))}}"> {{$course->title}}</a>
                                                </h1>
                                            </div>
                                            <!-- /.course-name -->
                                            @php
                                            $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($course->start_date));
                                            $getEnd_Date =  \Carbon\Carbon::parse(strtotime($course->end_date));
                                            @endphp
                                            <div class="course_setting text-right">
                                                <span class="course_date">
                                                    <i class="fa fa-calendar"></i>
                                                    من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}}                                                    </span>
                                            </div>
                                            <!-- /.course_setting -->
                                            <div class="course_instructor-data">
                                                <span>
                                                    <img src="{{asset($course->coures_instructor->avatar)}}" width="70" height="70" class="img-responsive">
                                                </span>
                                                <a href="{{route('courses.intro' ,Crypt::encrypt($course->id))}}">
                                                    <i class="fa fa-user"></i>{{$course->coures_instructor->username}}
                                                </a>
                                            </div>
                                            <!-- /.course_instructor-data -->
                                            <div class="corse-action">
                                               

                                                
                                                   
                                                    <a href=" {{route('subscriber.show' , Crypt::encrypt($course->id))}}" class="gonna-corse">
                                                        <i class="fa fa-paper-plane"></i> إذهب الي الدورة
                                                    </a>
                                              


                                               
                                                    <a href="#" class="out-corse">
                                                    
                                                        <i class="fa fa-sign-out"></i> إنسحاب من الدورة
                                                    </a>
                                               
                                               
                                            </div>
                                            <!-- /.corse-action -->
                                        </div>
                                        <!-- /.card-data -->

                                    </div>
                                    <!-- /.card-inner -->
                                </div>
                                @php
                                    $statusCount_start++;
                                @endphp
                              @endforeach
                              
                               
                            </div>
                            <!-- /.type -->
                           
                            @endif
                        
                            @if(++$if_count_start === $numItems_start)
                            @if($statusCount_start === 0)
                            <div class="flash_empty text-center">
                                <h1 class="animated shake">
                                    <i class="fa fa-frown-o"></i>
                                    عفواً لا يوجد لديك دورات في هذا القسم
                                </h1>
                            </div>
                            @endif
                            @endif
                            @endforeach

                            @endif
                        </div>
                        <!-- /#currentmy -->
                        <div role="tabpanel" class="tab-pane fade" id="commingmy">
                            @if( isset($did_not_start_course) && sizeof($did_not_start_course) > 0)
                            @php
                            $if_count_not_start = 0 ;
                            $statusCount_not_start = 0 ;
                            $numItems_not_start = count($did_not_start_course);
                            @endphp
                            
                            @foreach ($did_not_start_course as $item)

                          
                            @if(sizeof($item->courses) > 0 )

                           
                            <div class="type col-xs-12">
                                <div class="filtered-head text-right">
                                    <h1>
                                    <i class="fa fa-tags"></i>
                                    {{$item->name}}  
                              
                                </h1>
                                </div>
                                <!-- /.filtered-head -->
                                @foreach ($item->courses as $course)
                                <div class="card col-md-6 col-xs-12 pull-right">
                                    <div class="card-inner">
                                        <span class="corse-type">{{$course->coures_interest->name}}</span>
                                        <div class="card-img">
                                            <img src="/site/assets/images/b3.jpg" alt="" class="img-responsive">
                                            <div class="lessons-number text-center">
                                                <h1>
                                                <i class="fa fa-play-circle"></i>
                                                @if($course->case_payment_course === 1)
                                                <i class="fa fa-play-circle"></i>
                                                {{$course->course_price}}
                                                @else
                                                <i class="fa fa-play-circle"></i>
                                                    مجاني
                                                @endif
                                            </h1>
                                            </div>
                                            <!-- /.lessons-number -->
                                        </div>
                                        <!-- /.card-img -->
                                        <div class="card-data">
                                            <div class="course_name text-right">
                                                <h1>
                                                    <a href="{{route('courses.intro' ,Crypt::encrypt($course->id))}}"> {{$course->title}}</a>
                                                </h1>
                                            </div>
                                            <!-- /.course-name -->
                                            @php
                                            $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($course->start_date));
                                            $getEnd_Date =  \Carbon\Carbon::parse(strtotime($course->end_date));
                                            @endphp
                                            <div class="course_setting text-right">
                                                <span class="course_date">
                                                    <i class="fa fa-calendar"></i>
                                                    من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}}                                                    </span>
                                            </div>
                                            <!-- /.course_setting -->
                                            <div class="course_instructor-data">
                                                <span>
                                                    <img src="{{asset($course->coures_instructor->avatar)}}" width="70" height="70" class="img-responsive">
                                                </span>
                                                <a href="{{route('courses.intro' ,Crypt::encrypt($course->id))}}">
                                                    <i class="fa fa-user"></i>{{$course->coures_instructor->username}}
                                                </a>
                                            </div>
                                            <!-- /.course_instructor-data -->
                                            <div class="corse-action">
                                               
                                                <a href=" {{route('subscriber.show' , Crypt::encrypt($course->id))}}" class="gonna-corse">
                                                    <i class="fa fa-paper-plane"></i> إذهب الي الدورة
                                                </a>
                                                <a href="#" class="out-corse">
                                                    <i class="fa fa-sign-out"></i> إنسحاب من الدورة
                                                </a>
                                            </div>
                                            <!-- /.corse-action -->
                                        </div>
                                        <!-- /.card-data -->

                                    </div>
                                    <!-- /.card-inner -->
                                </div>
                                @php
                                    $statusCount_not_start++;
                                @endphp
                              @endforeach
                              
                               
                            </div>
                            <!-- /.type -->
                        
                            @endif

                            @if(++$if_count_not_start === $numItems_not_start)
                            @if($statusCount_not_start === 0)
                            <div class="flash_empty text-center">
                                <h1 class="animated shake">
                                    <i class="fa fa-frown-o"></i>
                                    عفواً لا يوجد لديك دورات في هذا القسم
                                </h1>
                            </div>
                            @endif
                        @endif
                            @endforeach

                            @endif
                        </div>
                        <!-- /#commingmy -->
                        
                       
                        <div role="tabpanel" class="tab-pane fade" id="finishedmy">
                            @if( isset($finished_course) && sizeof($finished_course) > 0)
                       
                            @php
                            $if_count_finished = 0 ;
                            $statusCountFinished = 0 ;
                            $numItems_finished = count($finished_course);
                            @endphp
                            @foreach ($finished_course as $item)
                          
                      
                          

                            @if(sizeof($item->courses) > 0 )

                           
                      
                            <div class="type col-xs-12">
                                <div class="filtered-head text-right">
                                    <h1>
                                    <i class="fa fa-tags"></i>
                                    {{$item->name}}  
                                  
                                   </h1>
                                </div>
                                <!-- /.filtered-head -->
                                @foreach ($item->courses as $course)

                              
                               
                                <div class="card col-md-6 col-xs-12 pull-right">
                                    <div class="card-inner">
                                        <span class="corse-type">{{$course->coures_interest->name}}</span>
                                        <div class="card-img">
                                            <img src="/site/assets/images/b3.jpg" alt="" class="img-responsive">
                                            <div class="lessons-number text-center">
                                                <h1>
                                                <i class="fa fa-play-circle"></i>
                                                @if($course->case_payment_course === 1)
                                                <i class="fa fa-play-circle"></i>
                                                {{$course->course_price}}
                                                @else
                                                <i class="fa fa-play-circle"></i>
                                                    مجاني
                                                @endif
                                            </h1>
                                            </div>
                                            <!-- /.lessons-number -->
                                        </div>
                                        <!-- /.card-img -->
                                        <div class="card-data">
                                            <div class="course_name text-right">
                                                <h1>
                                                    <a href="{{route('courses.intro' ,Crypt::encrypt($course->id))}}"> {{$course->title}}</a>
                                                </h1>
                                            </div>
                                            <!-- /.course-name -->
                                            @php
                                            $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($course->start_date));
                                            $getEnd_Date =  \Carbon\Carbon::parse(strtotime($course->end_date));
                                            @endphp
                                            <div class="course_setting text-right">
                                                <span class="course_date">
                                                    <i class="fa fa-calendar"></i>
                                                    من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}}                                                    </span>
                                            </div>
                                            <!-- /.course_setting -->
                                            <div class="course_instructor-data">
                                                <span>
                                                    <img src="{{asset($course->coures_instructor->avatar)}} width="70" height="70" class="img-responsive">
                                                </span>
                                                <a href="{{route('courses.intro' ,Crypt::encrypt($course->id))}}">
                                                    <i class="fa fa-user"></i>{{$course->coures_instructor->username}}
                                                </a>
                                            </div>
                                            <!-- /.course_instructor-data -->
                                            <div class="corse-action">
                                               

                                                @if($course->test_coursesHasOne->allow_print === 1)
                                                <a href="{{route('profile.course.print.certif.show' , Crypt::encrypt($course->test_coursesHasOne->id)  )}}" class="out-corse">
                                                    <i class="glyphicon glyphicon-print"></i> إطبع الشهاده
                                                </a>
                                                @else
                                                @if($course->test_coursesHasOne->created_at->diffInWeeks(now())  >= 2 && $course->test_coursesHasOne->allow_print !== 1 )
                                                <a href="{{route('profile.course.certif.requset.student' , Crypt::encrypt($course->test_coursesHasOne->id))}}" class="out-corse">
                                                    <i class="glyphicon glyphicon-exclamation-sign"></i> اطلب الشهاده
                                                </a>
                                                @else
                                                <div class="course_setting text-right">
                                                <span class="course_date"> اسبوعين لفتح طلب الشهاد الباقي : {{ 2 - $course->test_coursesHasOne->created_at->diffInWeeks(now())  }}  اسبوع </span>
                                                </div>
                                                @endif
                                                @endif
                                                <a href=" {{route('subscriber.show' , Crypt::encrypt($course->id))}}" class="gonna-corse">
                                                    <i class="fa fa-paper-plane"></i> إذهب الي الدورة
                                                </a>
                                            </div>
                                            <!-- /.corse-action -->
                                        </div>
                                        <!-- /.card-data -->

                                    </div>
                                    <!-- /.card-inner -->
                                </div>
                                @php
                                    $statusCountFinished++;
                                @endphp
                                 @endforeach
                               
                                 
                               
                            </div>
                            <!-- /.type -->
                          
                            <!-- /.flash_empty -->
                            @endif
                           
                           
        
                             
                                @if(++$if_count_finished === $numItems_finished)
                                @if($statusCountFinished === 0)
                                <div class="flash_empty text-center">
                                    <h1 class="animated shake">
                                        <i class="fa fa-frown-o"></i>
                                        عفواً لا يوجد لديك دورات في هذا القسم
                                    </h1>
                                </div>
                                @endif
                            @endif
                            @endforeach

                            @endif
                            

                        </div>
                        <!-- /#finishedmy -->
                    </div>

                </div>
            </div>
            <!-- /.my_courses-container -->
        </div>
        <!-- ./home_data -->
    </div>
    <!-- /.home-content -->
</div>
<!------------------------------------------------------>


                      </div>
                </div>
          </div>
    </div>
</div>
@endsection