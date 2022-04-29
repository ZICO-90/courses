
@extends('sites.layout-site')

@section('title')
المدرب / السيرة الذاتية
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
                       
                                  <div class="tab-content">
                                                  <div role="tabpanel" class="tab-pane fade active in" id="cv">
                                                      <div class="home-head">
                                                          <h1>
                                                              <i class="fa fa-file"></i>
                                                              أضف ملف سيرتك الذاتية

                                                          </h1>
                                                      </div>
                                                    <!-- /.home-head -->
                                                 <div class="home-content pass-content col-xs-12">
                                                         <div class="home_data col-xs-12 pull-right text-right">
                                                                 <div class="home_data-item col-md-12  col-xs-12 pull-right">
                                                                

                                                                    @if(empty($biography ))
                                                                    <div>
                                                                     {!!  Form::open(['route' => ['profile.course.update.cv']  ,'class' => "cv-file" , 'method' => 'POST']) !!}
                                                                            <h1>أضف رابط خارجي لملف السيرة الذاتية</h1>
                                                                            @error('biography_link')
                                                                            <span id="error-form">{{$message}}</span>
                                                                            @enderror
                                                                            {!! Form::url('biography_link' , null , ['placeholder' => "رابط خارجي"] ) !!}
                                                                            <h1>او يمكنك كتابتها بنفسك من خلال</h1>
                                                                            @error('biography')
                                                                            <span id="error-form">{{$message}}</span>
                                                                            @enderror
                                                                            {!! Form::textarea('biography' , null , ['placeholder' => "اكتب سيرتك الذاتية"] ) !!}
                                                                            <input type="submit" value="حفظ"> 
                                                                            {!! Form::close() !!}
                                                                    </div>
                                                                    
                                                                    <!-- /.cv-container -->
                                                         @else
                                                         <div>
                                                             {!!  Form::model($biography,['route' => ['profile.course.update.cv']  ,'class' => "cv-file" , 'method' => 'PUT' ]) !!}
                                                                 <input name="cv" type="hidden" value="{{Crypt::encrypt($biography->id)}}">
                                                                    <h1>أضف رابط خارجي لملف السيرة الذاتية</h1>
                                                                    @error('biography_link')
                                                                    <span id="error-form">{{$message}}</span>
                                                                    @enderror
                                                                    {!! Form::url('biography_link' , null , ['placeholder' => "رابط خارجي"] ) !!}
                                                                    <h1>او يمكنك كتابتها بنفسك من خلال</h1>
                                                                    @error('biography')
                                                                    <span id="error-form">{{$message}}</span>
                                                                    @enderror
                                                                    {!! Form::textarea('biography' , null , ['placeholder' => "اكتب سيرتك الذاتية"] ) !!}
                                                                    <input type="submit" value="حفظ">
                                                                    <a class="show-cv">عرض ملف السيرة الذاتية</a>
                                                                    {!! Form::close() !!}
                                                            </div>
                                                            <div class="cv-container text-center" style="display: none;">
                                                             <p></p>
                                                                @if(!empty($biography->biography_link))
                                                                       <a  target="_blank" href="{{$biography->biography_link}}">
                                                                           <i class="fa fa-cloud-download"></i> تحميل ملف السيرة الذاتية
                                                                       </a>
                                                                       @else
                                                             
                                                                 @endif
                                                         </div>
                                                            <!-- /.cv-container -->
                                                        
                                                      </div>
                                                      @endif

                                                                  
                                                                              
                                                                 </div>
                                                         </div>
                                                 </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                
     </div>
</div>

@endsection