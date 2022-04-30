
@extends('sites.layout-site')

@section('title')
معلومات عن الموقع
@endsection

@section('contacts')
<div class="profile-content empty-course">
     <div class="container">
        <div class="up-box contact-box text-right">
            <div class="container">
                <div class="contact-form col-md-6 col-xs-12 pull-right">
                    <div class="inner">
                        <h1>اتصل بنا مؤجله </h1>
                       
                    </div>
                    <!-- end inner -->
                </div>
                <!-- end contact-form -->
                <div class="FAQ col-md-6 col-xs-12 pull-left">
                    <div class="inner">
                        <h1>الاسئلة الشائعة</h1>
                        <div class="faq-item">
                          
                            <!-- end empty-msg -->
                            @if(sizeof($ask) > 0)
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach ($ask as $item)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="button" id="heading{{$item->id}}" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="panel-title">
                                        <a>
                                            <h5>
                                                <i class="fa fa-question-circle"></i>
                                            </h5>
                                         {{$item->question}}
                                        </a>
                                    </h4>
                                    </div>
                                    <div id="collapse{{$item->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$item->id}}">
                                        <div class="panel-body">
                                            <p>{{$item->answer}}</p>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /#collapseOne -->
                                </div>
                                @endforeach
                            
                                <!-- /.panel-default -->
                            
                            @else
                            <div class="empty-msg text-center animated shake">
                                <h1>
                        <i class="fa fa-frown-o"></i>
لا توجد اسئلة الان                                 </h1>
                            </div>
                            @endif
                        </div>
                        <!-- end faq-item -->
                    </div>
                    <!-- end inner -->
                </div>
                <!-- end FAQ -->
            </div>
            <!-- /.container -->
        </div>
                
     </div>
</div>

@endsection