
@extends('sites.layout-site')
@section('title')
الاهتمامات
@endsection


@section('contacts')
<div class="profile-content empty-course">
    <div class="container">
       
        @include('sites.includes.alerts.success')
        @include('sites.includes.alerts.info')
        @include('sites.includes.alerts.errors')
        @include('sites..profile.layout_ontant')

        <div class="left_tap-box col-md-9 col-xs-12 pull-left">
            <div class="left_box-inner">
                <!-- Tab panes -->
                <div class="tab-content">
                   
                    <div role="tabpanel" class="tab-pane fade active in" id="interests">
                        <div class="home-head">
                            <h1>
                                <i class="fa fa-diamond"></i>
                                الاهتمامات
                            </h1>
                        </div>
                        <!-- /.home-head -->
                        <div class="home-content pass-content col-xs-12">
                            <div class="home_data col-xs-12 pull-right text-right">
                                <div class="interest-show">
                                    <ul>
                                        @if(isset($user_interests) && sizeof($user_interests) > 0)
                                            @foreach ($user_interests as $item)
                                            <li>
                                                <span class="inter-item">{{$item->name}}
                                                    <i class="fa fa-times" id="del-item"></i>
                                                </span>
                                            </li>
                                            @endforeach
                                        @else
                                        <div class="alert alert-danger" role="alert">لا توجد اهتمامات برجاء اضافة اهتماماتك</div>
                                           
                                        @endif
                                       
                                        
                                        
                                    </ul>
                                </div>
                                <!-- /.interest-show -->
                                <div class="add-interest">
                                    <a>
                                        <i class="fa fa-plus"></i> أضف اهتمامات أخري
                                    </a>
                                </div>
                                <!-- /.add-interest -->
                                <div class="home_data-item col-md-12  col-xs-12 pull-right">

                                    <div class="interest-cont col-xs-12">
                                         @if(isset($all_interest) && sizeof($all_interest) > 0)

                                         {!!  Form::open(['route' => ['profile.interest.update', auth()->user()->id ]  , 'method' => 'PUT']) !!}
                                             @foreach ($all_interest as $item)
                                               
                                             <div class="interest-item col-md-4 col-sm-4 col-xs-6">
                                                <label>
                                                    {!! Form::checkbox('interest_id[]' ,  $item->id , $user_interests->contains($item->id ) ? true : false ) !!}
                                                    <span>{{$item->name}}</span>
                                                </label>
                                            </div>
                                             @endforeach

                                             @else

                                             <div class="alert alert-danger" role="alert">لا يوجد بيانات</div>
                                         @endif

                                       
                                    </div>
                                  
                                
                             
                                 
                                    <div class="interst-gender col-xs-12">
                                        <h1>نوع الدورات التي تفضل متابعتها </h1>
                                        <div class="add_cont text-right">
                                            @if(sizeof((array)auth()->user()->is_view) > 0)
                                            <label class="text-right">
                                                {!! Form::checkbox('is_view_gender[]' ,  1   ,  in_array("1" , auth()->user()->is_view ,true) ? true : false ) !!}
                                               
                                                <span>ذكور</span>
                                            </label>
                                            <label class="text-right">
                                                {!! Form::checkbox('is_view_gender[]' ,  2 , in_array("2", auth()->user()->is_view ,true ) ? true : false )  !!}
                                                <span>إناث</span>
                                            </label>
                                        @else
                                        <label class="text-right">
                                            {!! Form::checkbox('is_view_gender[]' ,  1    ) !!}
                                           
                                            <span>ذكور</span>
                                        </label>
                                        <label class="text-right">
                                            {!! Form::checkbox('is_view_gender[]' ,  2 )  !!}
                                            <span>إناث</span>
                                        </label>
                                        @endif
                                        </div>
                                        <div class="cv-file text-left">
                                            <input type="submit" value="حفظ">
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.interest-gender -->
                                </div>
                                <!-- /.home_data-item -->
                            </div>
                            <!-- ./home_data -->
                        </div>
                        <!-- /.home-content -->
                    </div>

                </div>
                <!-- /.tap-content -->
            </div>
            <!-- /.left_tap-box -->
        </div>
        <!-- /.left_tap-box -->
    </div>
    <!-- /.container -->
</div>
@endsection