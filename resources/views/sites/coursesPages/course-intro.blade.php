
@extends('sites.layout-site')

@section('title')
 تفاصيل عن : {{$intro_info_course->title}} 
@endsection

@section('css')
<link href="{{asset('site/assets/css/video-js.css')}}" rel="stylesheet" type="text/css">

@endsection


@section('contacts')
<div class="intro-container">
                <div class="intro-box">
                    <div class="container">
                        <div class="intro-name text-right">
                            <div class="name-head col-md-7 col-xs-12 pull-right">
                                <h1>{{$intro_info_course->title}}</h1>
                            </div>
                            <div class="extras col-md-5 col-xs-12">
                                <span>
                                  

                                    @if ($intro_info_course->case_payment_course === 0)
                                        مجاني                                           
                                    @else
                                    <i class="glyphicon glyphicon-usd"></i> {{$intro_info_course->course_price}}
                                    @endif
                                </span>
                                <div class="intro-rating">
                                    <ul>
                                        @for ($i = 0; $i < 5; $i++)

                                            @if($i  < $intro_info_course->star )
                                         
                                            <li class="rating" data-toggle="tooltip" data-placment="top">
                                                <a href="#">
                                                    <i class="fa fa-star"></i>
                                                </a>
                                            </li>
                                            @else
                                       
                                            <li class="rating" data-toggle="tooltip" data-placment="top">
                                                <a href="#">
                                                    <i class="fa fa-star" style="color: azure"></i>
                                                </a>
                                            </li>
                                            @endif
                                            
                                        @endfor
                        
                                       
                                    </ul>
                                </div>
                                <!-- end intro-rating -->
                            </div>
                        </div>
                        <!-- /.intro-name -->
                        <div class="intro-video col-xs-12 text-center">
                            <!--                        <iframe width="100%" height="520" src="https://www.youtube.com/embed/tTgD9m1p5Ss?list=PLT56sSeAKiIvfQhsA2lXUUmjfh0JyEFU7" frameborder="0" allowfullscreen></iframe>-->

                            @if ($intro_info_course->url_type === 0) 
                            <iframe width="100%" height="520" src="https://www.youtube.com/embed/{{$intro_info_course->youtube_id}}" frameborder="0" allowfullscreen></iframe>
                            @else
                            <video id="example_video_1" class="video-js vjs-default-skin" controls="true" width="100%" height="520" poster="{{asset('site/assets/images/3lom.jpg')}}">
                                <source src="{{asset($intro_info_course->url)}}" type='video/mp4' />
                            </video>
                            @endif
                            
                        </div>
                        <!-- /.intro-video -->

                        
                        <div class="intro-date col-xs-12 text-right">
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
                                          
                                $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($intro_info_course->start_date));
                                $getEnd_Date =  \Carbon\Carbon::parse(strtotime($intro_info_course->end_date));
                                
                               
                                 
                            @endphp
                            <h1>
                              <i class="fa fa-calendar"></i>
    من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}} @if(  $getSatrt_Date->diffInWeeks($getEnd_Date) !=0 ) - ({{ $getSatrt_Date->diffInWeeks($getEnd_Date) }} اسبوع) @else  - ({{ $getSatrt_Date->diffInDays($getEnd_Date) }} يوم )@endif
                            </h1>

                            @if(auth()->guard('web')->check())
                            
                                 @if($intro_info_course->instructor_id != auth()->guard('web')->user()->id)
                                            @if(auth()->guard('web')->user()->is_work != 1)

                                                    @if(in_array(auth()->guard('web')->user()->gender, $intro_info_course->is_subscribe))
                                            
                                                                @if($intro_info_course->case_payment_course === 1)
                                                               
                                                                            @if(auth()->guard('web')->user()->gateways->contains('course_id',$intro_info_course->id))
                                                                               <a href="{{route('subscriber.show' , Crypt::encrypt($intro_info_course->id))}}" title="اضغط لمتابعة الدورة" >
                                                                                  <i class="glyphicon glyphicon-folder-open"></i> انت مشترك  
                                                                            
                                                                               </a>
                                                                              
                                                                               <span class="label label-warning">تم الدفع</span>
                                                                              
                                                                             @else
                                                                               <a href="#"   id="gateway"  data-toggle="modal" data-target="#gatewayModalCenter">
                                                                                  <i class="fa fa-paper-plane"></i>  إشترك في الدورة
                                                                              </a>
                                                                              <span class="label label-primary">إشترك</span>
                                                                               @include('sites.includes.alerts.errors')
                                                                            @endif
               
                                                                 @else
                                                            
                                                                              @if( auth()->guard('web')->user()->courses()->get()->contains($intro_info_course->id) )
                                                                                      <a href="{{route('subscriber.show' , Crypt::encrypt($intro_info_course->id))}}" title="اضغط لمتابعة الدورة" >
                                                                                       <i class="glyphicon glyphicon-folder-open"></i> انت مشترك  
                                                                                 
                                                                                      </a>
                                                                                      <span class="label label-warning">مجاني</span>
                                                                                  @else
                                                                                  <a href="#"   id="gateway"  data-toggle="modal" data-target="#gatewayModalCenter">
                                                                                    <i class="fa fa-paper-plane"></i> إشترك في الدورة مجاني
                                                                                  </a>
                                                                                  @endif
                                                                @endif
                                             
                                                      @else
                                                          <a href="{{route('profile.show.acounts' , Crypt::encrypt( auth()->user()->id ) ) }}">
                                                              <i class="fa fa-cog"></i> عدل ملفك الشخصي لتستطيع الاشتراك في الدورة
                                                          </a>
                                                    @endif
                                              @else
                                                 <a   href="#"  style="pointer-events: none;"  onclick="return false" >
                                                     <i class="glyphicon glyphicon-ban-circle"></i> انت مدرب فقط 
                                                 </a>
                                         @endif

                                    @else
                                            
                                             <a href="{{route('subscriber.show' , Crypt::encrypt($intro_info_course->id))}}">
                                                 <i class="glyphicon glyphicon-minus-sign"></i>المدرب / دوراتي
                                             </a>
                                          
                                 @endif
                               
                           
                              @else
                                  <a href="#top">
                                      <i class="glyphicon glyphicon-alert"></i> إشترك في الدورة : برجاء تسجيل الدخول او تسجيل عضوية
                                  </a>
      
                                 
                          
                            @endif
                        </div>
                        <!-- /.intro-date -->
                        <div class="intro-details text-right">
                            <p>
                                {{$intro_info_course->details}}
                            </p>

                           
                                    
                        </div>
                        <!-- /.intro-details -->
                      
                       
                       
                
                        <div class="intro-extra col-xs-12">
                            <div class="intro-instructor col-md-6 col-xs-12 text-right pull-left">
                                <div class="intro_instructor-inner">
                                    <h1>عن المدرس</h1>
                                    <div class="avatar text-center">
                                        <div class="av-inner">
                                            @if(!empty($intro_info_course->coures_instructor->avatar))
                                            <img src="{{asset($intro_info_course->coures_instructor->avatar)}}" alt="" width="80" height="80">
                                                     
                                                            
                                                        @else
                                                      
                                                              @if($intro_info_course->coures_instructor->gender == 1)
                                                              <img src="{{asset('site/assets/images/s.png')}}"  alt="" width="80" height="80">
                                                              @elseif(auth()->user()->gender == 2)
                                                              <img src="{{asset('site/assets/images/avatar3.png')}}"  alt="" width="80" height="80">
                                                              @endif

                                                        @endif
                                            
                                        </div>
                                        <!-- /.av-inner -->
                                    </div>
                                  
                                    <!-- /.avatar -->
                                    <div class="instructor-data">
                                        <a href="#"   >{{$intro_info_course->coures_instructor->full_name}}</a>
                                        @if(!empty($intro_info_course->coures_instructor->biography))
                                           <p>
                                               {{$intro_info_course->coures_instructor->biography->biography}}
                                           </p>
                                              @if(!empty($intro_info_course->coures_instructor->biography->biography_link))
                                              <br>
                                                    <div class="cv-container text-center" style="display: block;">
                                                     
                                                      <a target="_blank" href="{{$intro_info_course->coures_instructor->biography->biography_link}}">
                                                     <i class="fa fa-cloud-download"></i>شاهد ملف السيرة الذاتيه كامل
                                                     </a>
                                                     </div>
                                              @endif
                                        @else
                                       
                                            <br>
                                            <br>
                                            <ol>
                                       
                                                <li>
                                                    <i class="glyphicon glyphicon-exclamation-sign"></i> لم يقم المدرب بتسجيل السيرة الذاتيه
                                                </li>
                                             
                                            </ol>
                                        
                                     
                                        @endif
                                    </div>
                                    <!-- /.instructor-data -->
                                </div>
                                <!-- /.intro_instructor-inner -->
                            </div>
                            <!-- /.intro-instructor -->

                          
                            @if($intro_info_course->is_activation === 0)
                            <div class="intro-lec col-md-6 col-xs-12 text-right pull-right">
                                <div class="intro_lec-inner">
                            <h1>لم تبدأ الدورة ولكن يمكن الاشتراك الي حين بدأها</h1>
    
                              </div>
    
                              </div>
                               @endif
                            <div class="intro-lec col-md-6 col-xs-12 text-right pull-right">
                                <div class="intro_lec-inner">
                                 
                                    <h1>ماذا يحتوي هذا الكورس</h1>
                                    @if(sizeof($intro_info_course->lessons) > 0)
                                    <ol>
                                        @foreach ($intro_info_course->lessons as $item)
                                        <li>
                                            <i class="fa fa-play-circle"></i> {{$item->name}}
                                        </li>
                                        @endforeach
                                    </ol>
                                    @else
                                   
                                    <ol>
                                       
                                        <li>
                                            <div class="empty-msg text-center animated shake">
                                               
                                                        <i class="fa fa-frown-o"></i>
                                                        لا يوجد دروس الان ولكن يمكنك الاشتراك في الدورة لحين بدأها
                                                    
                                            </div>
                                        </li>
                                     
                                    </ol>
                                    @endif
                                </div>
                                <!-- /.intro_lec-inner -->
                            </div>
                            <!-- /.intro-lec -->
                        </div>
                        <!-- /.intro-extra -->

                       
                    <div class="intro-extra col-xs-12">
                        <div class="intro-lec col-md-6 col-xs-12 text-right pull-left">
                            <div class="intro_lec-inner">
                               
                                <h1>متطلبات الدورة</h1>
                                @if( sizeof(((array)$intro_info_course->previous_requirement)) > 0)
                                     <ol>
                                         @foreach ( ((array)$intro_info_course->previous_requirement) as $item)
                                         <li>
                                             <i class="glyphicon glyphicon-ok"></i> {{$item}}
                                         </li>
                                         @endforeach
                                     </ol>
                                @else
                                     <ol>
                                          <li>
                                             <i class="glyphicon glyphicon-remove-sign"></i> لا توجد متطلبات سابقه لهذه الدورة
                                         </li>
                                     </ol>
                                @endif
                                
                              
                            </div>
                            <!-- /.intro_lec-inner -->
                        </div>
                        <!-- /.intro-lec -->
                    </div>
                   <!-- /.intro-extra -->
                 

                   
                   <div class="intro-extra col-xs-12">
                   <div class="intro-lec col-md-6 col-xs-12 text-right pull-left">
                       <div class="intro_lec-inner">
                           <h1>الشهاده</h1>
                           @if(!empty($intro_info_course->Certificate))
                                 <ol>
                                          <li title="اسم الشهاده">
                                              <i class="glyphicon glyphicon-education" title="اسم الشهاده"></i> {{$intro_info_course->Certificate->name}}
                                          </li>
                                         <li title="الجهة المناحه لشهاده">
       
                                             <i class="glyphicon glyphicon-home" title="الجهة المناحه لشهاده"></i> 
                                             {{$intro_info_course->Certificate->reference_certif}}
                                        
                                         </li>
                                         <li title="تكلفة الشهاده">
                                             @if($intro_info_course->Certificate->case_payment === 0)
                                                 <i class="glyphicon glyphicon-usd" title="تكلفة الشهاده"></i>  مجاني
                                         
                                             @else
                                                <i class="glyphicon glyphicon-usd" title="تكلفة الشهاده"></i>  {{$intro_info_course->Certificate->certifi_price}} $
                                             @endif
                                        </li>
                                 </ol>

                           @else
                                 <ol>
                                     <li>
                                        <i class="glyphicon glyphicon-remove-sign"></i>لا توجد شهاده لهذه الدورة
                                     </li>
                                 </ol>
                          @endif
                         
                       </div>
                       <!-- /.intro_lec-inner -->
                   </div>
                   <!-- /.intro-lec -->
               </div>
              <!-- /.intro-extra -->
            
                
                    </div>
                    <!-- /.container -->
                </div>
                
   
</div>
<!-- /.profile-content empty-course -->

@if(auth()->guard('web')->check())
  <!-- Modal -->
  @if($intro_info_course->case_payment_course === 1)
  <div class="modal fade" id="gatewayModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">طلب تأكيد عملية الدفع</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align: center">
           
             

                سوف يتم تحويلك الي بوابات الدفع الالكتروني برجاء المتابعه

                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
          <button type="submit" form="payOrder" class="btn btn-primary">متابعه</button>
          {!!  Form::open(['route' => 'courses.payment'  , "id" => "payOrder" , 'method' => 'POST' ]) !!}
          <input type="hidden" name="UPayI" value="{{Crypt::encrypt(auth()->guard('web')->user()->id)}}"/>
          <input type="hidden" name="CPayI" value="{{Crypt::encrypt($intro_info_course->id)}}"/>
        
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  @else

  <div class="modal fade" id="gatewayModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">طلب تأكيد عملية االاشتراك</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align: center">
           
             

هل انت متاكد من الاشتراك في هذه الدوره ؟
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
          <button type="submit" form="payOrder" class="btn btn-primary">نعم</button>
          {!!  Form::open(['route' => 'subscriber.course.free'  , "id" => "payOrder" , 'method' => 'POST' ]) !!}
          <input type="hidden" name="student" value="{{Crypt::encrypt(auth()->guard('web')->user()->id)}}"/>
          <input type="hidden" name="course" value="{{Crypt::encrypt($intro_info_course->id)}}"/>
        
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  @endif
  @endif
@endsection


@section('js_course')
<script src="{{asset('site/assets/js/video.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    var myPlayer = videojs("example_video_1");

    $('#show-l10').click(function () {
        $('#l10').show();
        $('#example_video_1').hide();
        myPlayer.pause();
    });
</script>
<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
      
           $(this).before($('.modal-backdrop'));
           $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
          }); 
    });   
</script>

@endsection