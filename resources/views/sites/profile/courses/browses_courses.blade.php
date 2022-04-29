
@extends('sites.layout-site')

@section('title')
تصفح الدورات
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
<div role="tabpanel" class="tab-pane fade active in" id="all-courses">
    <div class="home-head">
        <h1>
            <i class="fa fa-eye"></i>
            جميع الدورات
        </h1>
    </div>
    <!-- /.home-head -->
    <div class="home-content pass-content col-xs-12">
        <div class="home_data col-xs-12 pull-right text-right">
            <div class="my_courses-container">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#current" aria-controls="current" role="tab" data-toggle="tab" data-original-title="" title="" aria-expanded="true">الدورات الحالية</a></li>
                        <li role="presentation" class=""><a href="#comming" aria-controls="comming" role="tab" data-toggle="tab" data-original-title="" title="" aria-expanded="false">الدورات القادمة</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="current">
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
                            @if( isset($filter_by_cource_active) && sizeof($filter_by_cource_active) > 0)

                            @php
                            $if_count_active = 0 ;
                            $statusCount_active = 0 ;
                            $numItems_active = count($filter_by_cource_active);

                            $if_count = 0 ;
                         
                            @endphp
                            @foreach ($filter_by_cource_active as $item)

                           

                                
                                @if(sizeof($item->courses) > 0 )

                                <div class="type col-xs-12">
                                    @foreach ($item->courses  as $check)

                                    @if( !$isSubscribes->contains($check->id))
                                    
                              
                                    @if($if_count === 0)
                                    
                                    <div class="filtered-head text-right">
                                        <h1>
                                        <i class="fa fa-tags"></i>
                                             {{$item->name}}                     
                                        </h1>
                                    </div>

                                    @endif

                                    @php
                                        $if_count++
                                    @endphp
                                
                                    @endif

                                    @endforeach
                                              
                                    @php
                                    $if_count = 0
                                    @endphp

                              
                           
                                @foreach ($item->courses as $course)
                                    
                                @if( ! $isSubscribes->contains($course->id) )
                             
                                      <!-- /.filtered-head -->
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
                                                    من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}}                                                </span>
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
                                        </div>
                                        <!-- /.card-data -->

                                    </div>
                                    <!-- /.card-inner -->
                                </div>
                                <!-- /.card -->
                                @php
                                     $statusCount_active++;
                                @endphp
                                @endif
                                   
                           
                                @endforeach
                             
                            </div>
                                @endif

                                @if(++$if_count_active === $numItems_active)
                                @if($statusCount_active === 0)
                                <div class="flash_empty text-center">
                                    <h1 class="animated shake">
                                        <i class="fa fa-frown-o"></i>
                                         عفواً لا يوجد لديك دورات في هذا القسم
                                    </h1>
                                </div>
                                @endif
                            @endif
                            @endforeach
                           
                            @else
                           
                                <div class="flash_empty text-center">
                                    <h1 class="animated shake">
                                        <i class="fa fa-frown-o"></i>
                                        عفواً لا يوجد لديك دورات في هذا القسم
                                    </h1>
                                </div>
                                <!-- /.flash_empty -->
                            
                            @endif
                            <!-- /.type -->
                     
                            <!-- /.type -->
                        </div>
                        <!-- /#current -->

                        <!-- -------------------------------------------------------------------------------- -->
                        <div role="tabpanel" class="tab-pane fade" id="comming">
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
                            @if( isset($filter_by_cource_Notactive) && sizeof($filter_by_cource_Notactive) > 0)

                          
                            @php
                            $if_count_numItems = 0 ;
                            $statusCount_Notactive= 0 ;
                            $numItems_Notactive = count($filter_by_cource_Notactive);

                            $if_count_Notactive = 0 ;
                         
                            @endphp
                            @foreach ($filter_by_cource_Notactive as $item)
                                
                                @if(sizeof($item->courses) > 0)
                              
                            <div class="type col-xs-12">

                                @foreach ($item->courses  as $check)
                                @if( !$isSubscribes->contains($check->id))

                                @if($if_count_Notactive === 0)
                                <div class="filtered-head text-right">
                                    <h1>
                                    <i class="fa fa-tags"></i>
                                         {{$item->name}}                     
                                    </h1>
                                </div>
                                @endif

                                @php
                                   $if_count_Notactive++; 
                                @endphp

                                @endif
                                @endforeach
                                @php
                                $if_count_Notactive = 0; 
                                @endphp
                                @foreach ($item->courses as $course)
                                   
                                        @if( !$isSubscribes->contains($course->id) )
                                        <!-- /.filtered-head -->
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
                                                            من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}}                                                </span>
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
                                                </div>
                                                <!-- /.card-data -->
        
                                            </div>
                                            <!-- /.card-inner -->
                                        </div>
                                        <!-- /.card -->
                                        
                                        @php
                                        $statusCount_Notactive++;
                                         @endphp
                                        @endif
                                @endforeach
                             
                            </div>
                                @endif

                                @if(++$if_count_numItems === $numItems_Notactive)
                               
                                    @if($statusCount_Notactive === 0)
                                    <div class="flash_empty text-center">
                                        <h1 class="animated shake">
                                            <i class="fa fa-frown-o"></i>
                                             عفواً لا يوجد لديك دورات في هذا القسم
                                        </h1>
                                    </div>
                                    @endif
                                @endif
                              
                            @endforeach
                           
                            @else
                           
                                <div class="flash_empty text-center">
                                    <h1 class="animated shake">
                                        <i class="fa fa-frown-o"></i>
                                        عفواً لا يوجد لديك دورات في هذا القسم
                                    </h1>
                                </div>
                                <!-- /.flash_empty -->
                            
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.my_courses-container -->
        </div>
        <!-- ./home_data -->
    </div>
    <!-- /.home-content -->
</div>
</div>
</div>
</div>
</div>
</div>
@endsection