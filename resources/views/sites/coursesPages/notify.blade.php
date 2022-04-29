

@extends('sites.layout-site')

@section('title')
 اتابع الان دورة: {{$getNotify->title}} 
@endsection




@section('contacts')


<div class="intro-container col-xs-12">
          <div class="corse-box col-xs-12">
              <div class="corse-nav text-center">
                  <div class="container">
                      <ul>
                          <li>
                              <a href="{{route('subscriber.show' , request()->route()->parameters['id'])}}">
                                  <i class="fa fa-tasks"></i> الدروس
                              </a>
                          </li>
          
                          <li>
                              <a href="course-comments.html">
                                  <i class="fa fa-commenting-o"></i> النقاشات
                              </a>
                          </li>
          
                          <li>
                              <a href="course-alerts.html" class="{{$getNotify->id === Crypt::decrypt(request()->route()->parameters['id']) ? 'active' : ''}}">
                                  <span class="padge">{{auth()->user()->unreadnotifications->count()}}</span>
                                  <i class="fa fa-bell"></i> التنويهات
                              </a>
                          </li>
                      </ul>
                  </div>
                  <!-- end container -->
              </div>
              <!-- end corse-nav -->
              <div class="lesson-box text-right">
                  <div class="container">
                      <div class="alert-box">
                          <div class="all-alerts col-xs-12 text-right">
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
                              <ul>
                                @foreach(auth()->user()->unreadnotifications as $notify)
                                @if($notify->type == "App\Notifications\SendStudentsInSubscribersCourseNotify")
                                  <li>
                                    <h1>{{$notify->data['title']}}</h1>
                                    @php
                                    $date =  \Carbon\Carbon::parse(strtotime($notify->created_at));
                                     @endphp
                                    <span>
                                        
                                        {{$date->format('d')}} {{$months[$date->format('F')]}} {{$date->format('Y')}}
                                    </span>
                                    <p>
                                        {{$notify->data['body']}}
                                    </p>
                                 </li>
                                 @endif
                                  @endforeach
                                
                            
                              </ul>
                          </div>
                         
                          <!-- end empty-msg -->
                      </div>
                      <!-- end alert-box -->
                  </div>
                  <!-- end container -->
              </div>
              <!-- end lesson-box -->
          </div>
</div>
@endsection