@extends('sites.layout-site')

@section('title')
اختبار دورة {{$getTest->title}}
@endsection
@section('contacts')

<div class="intro-container col-xs-12">
<div class="up-box">
    
    <div class="container">
        @if(empty($getEndTestStudent))
        <div class="up-form">
           
            <div id="tabsleft" class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                    @include('sites.includes.alerts.info')
                    @foreach ($getTest->questions as $index => $item)
                        @if($index === 0)
                        <li class="active"><a href="#tabsleft-tab{{$index + 1}}" data-toggle="tab" aria-expanded="true" data-original-title="" title="">الخطوة {{$index + 1}}</a></li>

                        @else
                        <li class=""><a href="#tabsleft-tab{{$index + 1}}" data-toggle="tab" data-original-title="" title="" aria-expanded="false">الخطوة {{$index + 1}}</a></li>
                        @endif
                        
                    @endforeach
                   
                   
                </ul>
                <div id="bar" class="progress progress-info progress-striped">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 14.2857%;"></div>
                </div>
                {!!  Form::open(['route' => ['subscriber.test.finished' , ['id' => Crypt::encrypt($getTest->id)]]  ,'id' => "form_finished" , 'method' => 'POST']) !!}

                <div class="tab-content">

                    @foreach ($getTest->questions as $key => $item)
                  
                    
                 
                    <div class="tab-pane {{$key === 0 ? 'active' : ''}}" id="tabsleft-tab{{$key + 1}}">
                        <div class="quest text-right">
                            <div class="quest-head">
                                <h1>{{$item->question}}</h1>
                            </div>
                            <!-- end quest-head -->
                            
                            <div class="quest-answers">
                               
                            @foreach ($item->QuestionAnswers as $quest)
                         
                                <div class="answer">
                                    <label>
                                       @php
                                           $value = Crypt::encrypt($quest->true_false) 
                                       @endphp
                                        {!! Form::radio('k[' . $item->id .']' ,$quest->id,   old('k['.$item->id.']') === $quest->id ? true : false , ['id' => "make-answer" ] ) !!}
                                        <span>{{$quest->answer}}</span>
                                    </label>
                                   
                                 
                                </div>
                                <!-- end answer -->
                                @endforeach
                              
                          
                            </div>
                            <!-- end quest-answers -->
                         
                         
                        </div>
                        <!-- end quest -->
                      
                    </div>
                 
                    @endforeach

                  
                    <ul class="pager wizard">
                        <!--                        <li class="previous first"><a href="javascript:;">First</a></li>-->
                        <li class="previous disabled"><a href="javascript:;">الخطوة السابقة</a></li>
                        <!--                        <li class="next last"><a href="javascript:;">Last</a></li>-->
                        <li class="next" style=""><a href="javascript:;">الخطوة التالية</a></li>
                        <li class="next finish hidden" style="display: none;"><a  onclick="document.getElementById('form_finished').submit(); return false;" href="javascript:;">انهاء</a></li>
                    </ul>
                </div>
                  {!! Form::close() !!}
            </div>
            
        </div>
        <!-- /.up-form -->
        @else
        
                 <!-- end certf -->
                       <div class="empty-msg text-center animated shake">
                          <h1>
                                  <i class="glyphicon glyphicon-education"></i>
                                  قد انهيت الاختبار وسوف تتاكد الادارة من النتيجه وسيتم تجهيز الشهادة لك  لطباعتها
                              </h1>
                              
                       </div>
        
            
            @endif
    </div>
    <!-- /.container -->
</div>
</div>
@endsection


@section('js_course')

<script src="{{asset('site/assets/js/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $('#tabsleft').bootstrapWizard({
        'tabClass': 'nav nav-tabs',
        'debug': false,
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#tabsleft .progress-bar').css({
                width: $percent + '%'
            });

            // If it's the last tab then hide the last button and show the finish instead
            if ($current >= $total) {
                $('#tabsleft').find('.pager .next').hide();
                $('#tabsleft').find('.pager .finish').show();
                $('#tabsleft').find('.pager .finish').removeClass('disabled');
            } else {
                $('#tabsleft').find('.pager .next').show();
                $('#tabsleft').find('.pager .finish').hide();
            }

        }
    });

    $('#tabsleft .finish').click(function () {
        alert('Finished!, Starting over!');
        $('#tabsleft').find("a[href*='tabsleft-tab1']").trigger('click');
    });
</script>
@endsection