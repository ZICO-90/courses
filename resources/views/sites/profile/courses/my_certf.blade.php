

@extends('sites.layout-site')

@section('title')
الشهادات التي حصلت عليها من انهاء الدورات
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

                                    <div role="tabpanel" class="tab-pane fade active in" id="my_certf">
                                        <div class="home-head">
                                            <h1>
                                                <i class="fa fa-file"></i>
                                                الشهادات التي حصلت عليها من انهاء الدورات
                                            </h1>
                                        </div>
                                        @if(Session::has('info'))
                                        <div class="alert alert-danger" dir="rtl" role="alert">{{ Session::get('info') }}</div>
                                        @endif
                                        <!-- /.home-head -->
                                        <div class="home-content pass-content col-xs-12">
                                            <div class="home_data col-xs-12 pull-right text-right">
                                                <div class="home_data-item col-md-12  col-xs-12 pull-right">
                                                    <div class="my-sertf">


                                                        <ul>
                                                            @foreach ($my_certf as $item)
                                                            <li>
                                                                <h1>
                                                                    <i class="fa fa-file"></i>
                                                                    {{$item->course->title}}
                                                                    
                                                                 
                                                                </h1>
                                                               

                                                             
                                                                @if($item->allow_print === 1)
                                                                <a href="{{route('profile.course.print.certif.show' , Crypt::encrypt($item->id))}}" class="out-corse">
                                                                    <i class="fa fa-cloud-download"></i> إطبع الشهاده
                                                                </a>
                                                                @else
                                                                @if($item->created_at->diffInWeeks(now())  >= 2 && $item->allow_print !== 1 )
                                                                <a href="{{route('profile.course.certif.requset.student' , Crypt::encrypt($item->id))}}" >
                                                                    <i class="glyphicon glyphicon-exclamation-sign"></i> اطلب الشهاده
                                                                </a>
                                                                @else                                                           
                                                                <span>تنبيه اذ لما تصلك الشهاده خلال اسبوعين سوف يتم فتح طلب  لشهاد الباقي : {{ 2 - $item->created_at->diffInWeeks(now()) }}  اسبوع</span>
                                                                @endif
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                  
                                                      
                                                        </ul>
                                                    </div>
                                                    <!-- end my-certf -->
                                                </div>
                                                <!-- /.home_data-item -->
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