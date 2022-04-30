

@extends('sites.layout-site')

@section('title')
 اتابع الان دورة: {{$show_info_course->title}} 
@endsection

@section('css')

@if($show_info_course->is_activation === 0)
<style>
  
.corse-box .lesson-box ul li a {
  
  cursor: help;
}
</style>
@endif

<style>


.wrapper input {
   
  border: 0;
  width: 1px;
  height: 1px;
  overflow: hidden;
  position: absolute !important;
  clip: rect(1px 1px 1px 1px);
  clip: rect(1px, 1px, 1px, 1px);
  opacity: 0;
}

.wrapper label {
  position: relative;
  float: right;
  color: #C8C8C8;
}

.wrapper label:before {

  content: "\f005";
  font-family: FontAwesome;
  display: inline-block;
 
  color: #ccc;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.wrapper input:checked ~ label:before {
  color: #FFC107;
}

.wrapper label:hover ~ label:before {
  color: #ffdb70;
}

.wrapper label:hover:before {
  color: #FFC107;
}

</style>
@endsection


@section('contacts')

<div class="intro-container col-xs-12">
   

    <div class="corse-box col-xs-12">
        <div class="corse-nav text-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="container">
                <ul>
                   
                    {{--
                        
                        --}}
                    @if($show_info_course->instructor_id  === auth()->guard('web')->user()->id)
                    <li>
                        <a href="#" style="background: #E2135F" data-toggle="modal" data-target="#gatewayModalCenter">
                            <i class="fa fa-bullhorn"></i> إضافة تنويه
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color: #177DC5;"  data-toggle="modal" data-target="#messageEmailForAllSudents">
                            <i class="fa fa-envelope"></i> إرسال للجميع
                        </a>
                    </li>
                    @endif

                    <li>
                        <a href="{{route('subscriber.show' , request()->route()->parameters['id'])}}" class="{{$show_info_course->id === Crypt::decrypt(request()->route()->parameters['id']) ? 'active' : ''}}">
                            <i class="fa fa-tasks"></i> الدروس
                        </a>
                    </li>

                    
                       

                        <li>
                            <a href="{{route('profile.course.notify.Subscribers.show' , request()->route()->parameters['id'])}}">
                                <i class="fa fa-bell"></i> التنويهات
                            </a>
                        </li>
                      
                        <li class="rating" data-toggle="tooltip" data-placment="top" title="" data-original-title="إضافة تقييم للدورة">
                            <ul>

                                @for ($i = 0; $i < 5; $i++)

                                @if($i  < $show_info_course->star )
                             
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star active"></i>
                                    </a>
                                </li>
                                @else
                           
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                @endif
                                
                            @endfor
                               
                            
                            </ul>
                        </li>

            <li class="rating" data-toggle="tooltip" data-placment="top" title="" data-original-title="إضافة تقييم للدورة">     
                <div class="wrapper" dir="ltr">
                    <ul>
                        <li>
                  {!!  Form::open(['route' => 'subscriber.rating'  , 'method' => 'POST' ]) !!}        
                    <input onchange='this.form.submit();' name="ratingRadio" type="radio" id="st5" value="5" />
                    <label for="st5"></label>
           
                    <input onchange='this.form.submit();' name="ratingRadio" type="radio" id="st4" value="4" />
                    <label  for="st4"></label>
           
                    <input onchange='this.form.submit();' name="ratingRadio" type="radio" id="st3" value="3" />
                    <label for="st3"></label>
           
                    <input onchange='this.form.submit();' name="ratingRadio" type="radio" id="st2" value="2" />
                    <label  for="st2"></label>
           
                    <input onchange='this.form.submit();' name="ratingRadio" type="radio" id="st1" value="1" />
                    <label  for="st1"></label>

                    <input  name="idCourse" type="text" value="{{ request()->route()->parameters['id'] }}" />
                    {!! Form::close() !!}
                        </li>
                    </ul>
                 </div>
                
            </li>
                </ul>

                <!-- =========================================================================================================================================== -->
                @if($show_info_course->instructor_id   === auth()->guard('web')->user()->id)
              
                                        
                <div class="modal fade" id="gatewayModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                        
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" style="text-align: center">
                           
                             
                            {!!  Form::open(['route' => 'profile.course.notify.Subscribers'  , "id" => "notify" , 'method' => 'POST' ]) !!}

                            
                           
                            
                        
                                <div class="lost-inner">
                                    <h1>
                                        <i class="fa fa-envelope"></i>
                                        اضافة تنويه للطلاب المشتركين في الدورة
                                    </h1>
                                    <div class="lost-item" id="alert-item">
                                       
                                        <textarea placeholder="عنوان التنويه" name="title"></textarea>
                                    </div>
                                    <!-- /.lost-item -->
                                    <div class="lost-item" id="alert-item">
                                        <textarea placeholder="مضمون التنويه" name="body"></textarea>
                                    </div>

                                  
                                    <input type="hidden"  name="courseId" value="{{request()->route()->parameters['id']}}">
                                    <input type="hidden"  name="instructorId" value="{{Crypt::encrypt($show_info_course->instructor_id )}}">
                                    <!-- /.lost-item -->
                                    <div class="text-center">
                                       
                                        <button type="submit" class="btn btn-secondary" >نشر التنويه</button>
                                    </div>
                                    <!-- /.lost-item -->
                                </div>
                                <!-- /.lost-inner -->
                            
                              {!! Form::close() !!}
                                
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
                          
                          
                        </div>
                      </div>
                    </div>
                </div>




                <div class="modal fade" id="messageEmailForAllSudents" tabindex="-1" role="dialog" aria-labelledby="messageModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                        
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" style="text-align: center">
                           
                             
                            {!!  Form::open(['route' => 'profile.course.notify.subscribers.send.mail'  , "id" => "email" , 'method' => 'get' ]) !!}

                            
                            <div class="lost-inner">
                                <h1>
                                                                            <i class="fa fa-envelope"></i>
                                                                            إرسال لجميع الطلاب المشتركين في الدورة
                                                                        </h1>
                                <div class="lost-item" id="messageTo">
                                    <textarea placeholder="اكتب الرسالة هنا" name="message" required></textarea>
                                </div>
                                <input type="hidden"  name="courseId" value="{{request()->route()->parameters['id']}}">
                                <!-- /.lost-item -->
                                <div class="text-center">
                                  
                                    <button type="submit" class="btn btn-secondary" >إرسال</button>
                                </div>
                                <!-- /.lost-item -->
                            </div>
                            
                            <!-- /.modal -->
                            
                              {!! Form::close() !!}
                                
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
                          
                          
                        </div>
                      </div>
                    </div>
                </div>


                          
               @endif
                <!-- =========================================================================================================================================== -->
            </div>
            <!-- end container -->
        </div>
        <!-- end corse-nav -->
        <div class="lesson-box text-right">
            <div class="container">
                @php
                $test =  auth()->guard('web')->user()->test_courses()->where('cource_id' ,$show_info_course->id )->first();
             
                @endphp
                @if(! empty($show_info_course->Certificate))
                    
                @if(! empty($test) && auth()->guard('web')->user()->id != $show_info_course->instructor_id )

    
                @if($test->allow_print === 1)
                <div class="certf text-center animated bounceIn">
                    <h1>تهانينا لقد  انتهيت من هذه الدورة بنجاح </h1>
                    <a href="#">
                        <i class="fa fa-print"></i> تستطيع طباعة الشهادة
                    </a>
                </div>
                @else
                <div class="certf text-center animated bounceIn">
                    <h1>تهانينا لقد  انتهيت من هذه الدورة بنجاح </h1>
                   
                </div>
                @endif

                @endif

                @else
                <div class="certf text-center animated bounceIn">
                    <h1>طبقا لتفاصيل السابقة قبل اشتراكك في هذه الدورة !! لا يوجد لهذه الدورة شهاده</h1>
                    
                </div>
                @endif
              
                @if($show_info_course->is_activation === 0)
                        @if(sizeof($show_info_course->lessons) > 0)
                  
                          <!-- end empty-msg -->
                          <div class="week-module text-right">
                            <h1>
                                <i class="glyphicon glyphicon-indent-left"></i>
                                محتوي الدورة
                            </h1>
                            <span class="label label-default">لم تبدأ</span>
                        </div>
                        <!-- end week-moduke -->
                        
                        <ul>
                            @foreach ($show_info_course->lessons as $item)
                           <li>
                               <a style="pointer-events: none;"  onclick="return false" class="lesson-det">
                                   <i class="fa fa-play-circle"></i>
                                   <span class="lesson-name">{{$item->name}}</span>
                               </a>
                               <h3>{{$item->time}}</h3>
                              
       
                           </li>
                           @endforeach
                              
       
                       
                       </ul>
                        @else
                            <!-- end certf -->
                             <div class="empty-msg text-center animated shake">
                                 <h1>
                                         <i class="fa fa-frown-o"></i>
                                         لا يوجد دروس الان ولكن يمكنك الاشتراك في الدورة لحين بدأها
                                     </h1>
                             </div>
                             <!-- end empty-msg -->
                        @endif

                @else
                        @if(sizeof($show_info_course->lessons) > 0)
                              <!-- end empty-msg -->
                          <div class="week-module text-right">
                            <h1>
                                <i class="glyphicon glyphicon-indent-left"></i>
                                محتوي الدورة
                            </h1>
                            
                        </div>
                        <!-- end week-moduke -->
                             
                             <ul>
                             
                                @foreach ($show_info_course->lessons as $item)

                                    <li>
                                        <a href="{{route('subscriber.individual.show' ,Crypt::encrypt($item->id) )}}" class="lesson-det">
                                            <i class="fa fa-play-circle"></i>
                                            <span class="lesson-name">{{$item->name}}</span>
                                        </a>
                                        
                                        <h3>{{$item->time}}</h3>
                                
                                        @if($show_info_course->instructor_id == auth()->guard('web')->user()->id )
                                              <a href="#" class="del-lesson" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف الدرس">
                                                  <i class="fa fa-trash"></i>
                                              </a>
                                        @else
                                      
                                             @if($show_info_course->lessone_course->contains(function ($val) use ($item) { return $val->lesson_id  == $item->id && $val->cource_id == $item->cource_id &&  $val->student_id  == auth()->guard('web')->user()->id;}))
                                              <a class="del-lesson-student"  onclick="return false"  title="شاهده">
                                                  <i class="glyphicon glyphicon-ok-circle"></i> 
                                              </a>
                                             
                                              @else
                                              <a class="del-lesson"   onclick="return false"  title="لم يشاهده">
                                                  <i class="glyphicon glyphicon-exclamation-sign"></i> 
                                              </a>
                                              @endif
                                             
                                        @endif
                                             
                                       
                                     
                                    </li>
            
                           
                                @endforeach    
                         
                            </ul>
                        @else
                                 <!-- end certf -->
                                 <div class="empty-msg text-center animated shake">
                                    <h1>
                                            <i class="fa fa-frown-o"></i>
                                            لا يوجد دروس الان ولكن يمكنك الاشتراك في الدورة لحين بدأها
                                        </h1>
                                 </div>

                        @endif

                @endif
               
           

                @if(sizeof($show_info_course->lessons) === sizeof($OpenTest)  && sizeof($show_info_course->lessons) !== 0 )
                <div class="take-exam col-xs-12 text-center">
                    <a href="{{route('subscriber.test.show',   request()->route()->parameters['id'] )}}">
                        <i class="fa fa-file-text-o"></i> ابدا الاختبار الان
                    </a>
                </div>
                <!-- end take-exam -->
                @endif
            </div>
            <!-- end container -->
        </div>
        <!-- end lesson-box -->
    </div>
    <!-- end corse-box -->

</div>



@endsection

@section('js_course')

<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
      
           $(this).before($('.modal-backdrop'));
           $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
          }); 
    });   
</script>
@endsection