@extends('dashboardAdmins.layout_admin')

@section('title')
دورات المدرب
@endsection
@section('css')
@endsection
@section('contents')
<div class="panel panel-body">

    
    <div class="content-group">
       
        @if($course_instructor->url_type === 0)
        <div class="embed-responsive embed-responsive-16by9 content-group">
            <iframe class="embed-responsive-item" allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://www.youtube.com/embed/{{$course_instructor->youtube_id}}" webkitallowfullscreen=""></iframe>
        </div>
       
        @else
              
        <video class="img-responsive img-rounded" poster="{{asset('site/assets/images/3lom.jpg')}}">
            <source src="{{asset($course_instructor->url)}}" type='video/mp4' />
        </video>
        @endif
    </div>

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
        $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($course_instructor->start_date));
        $getEnd_Date =  \Carbon\Carbon::parse(strtotime($course_instructor->end_date));
   @endphp
           <h5 class="panel-title">  تفاصيل الدورة <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>

    <ul class="list content-group">
        <li><span class="text-semibold">عنوان الدورة : {{$course_instructor->title}} </span> </li>
        
        <li><span class="text-semibold">السعر$ : {{$course_instructor->case_payment_course === 0 ? 'مجاني' :  $course_instructor->course_price }}</span> </li>
        <li><span class="text-semibold">حالة الدورة :  {{$course_instructor->is_activation === 0 ? 'لم تنشر' : 'نشرت'}} </span></li>
        <li><span class="text-semibold">زمن بدأ الدورة :     من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}} @if(  $getSatrt_Date->diffInWeeks($getEnd_Date) !=0 ) - ({{ $getSatrt_Date->diffInWeeks($getEnd_Date) }} اسبوع) @else  - ({{ $getSatrt_Date->diffInDays($getEnd_Date) }} يوم )@endif</span></li>
      
    </ul>
    <hr>
    <h5 class="panel-title"> تفاصيل الشهاده<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
  
        @if(!empty($course_instructor->Certificate))
        <ul class="list content-group">
            <li><span class="text-semibold">مسمي الشهاده : {{$course_instructor->Certificate->name}} </span> </li>
            <li><span class="text-semibold">الجهة المناحه : {{$course_instructor->Certificate->reference_certif}} </span> </li>
            <li><span class="text-semibold">السعر $ : {{$course_instructor->Certificate->case_payment === 0 ? 'مجاني' :  $course_instructor->Certificate->certifi_price }}</span> </li>
            <li><span class="text-semibold">حالة طباعه الشهاده :  {{$course_instructor->Certificate->is_active_print === 0 ? 'عدم السماح' : 'السماح' }} </span></li>
          
        </ul>

        @else
        <ul class="list content-group">
            <li><span class="text-semibold">لا توجد شهاده لهذه الدوره </span> </li>
           
          
        </ul>
        @endif
</div>

<div class="row">
  @foreach ($course_instructor->lessons as $item)
    <div class="col-md-4">
        <div class="panel-body"></div>
        <div class="panel panel-flat">
            <div class="panel-body" style="word-wrap: break-word; overflow-wrap: break-word;">
                <div class="thumb content-group">
                   
                    @if($item->url_type === 0)
                    <iframe class="img-responsive"  src="https://www.youtube.com/embed/{{$item->youtube_id}}" ></iframe>

                    @else
               
                    <video class="img-responsive"  controls poster="{{asset('site/assets/images/3lom.jpg')}}">
                        <source  src="{{asset($item->url_video)}}" type="video/mp4">


                      </video>  
                    @endif
                </div>
                
                <h5 class="text-semibold">
                    <a href="#" class="text-default">{{$item->name}}</a>
                </h5>
          
                <ul class="list-inline list-inline-separate text-muted content-group">
                    
                    <li>{{$item->created_at->format('Y-F-d')}}</li>
                    <li> وقت {{$item->time}}</li>
                </ul>
               
                {{$item->detalis}}
            </div>

           
        </div>

    </div>

  @endforeach
   
  
</div>

@endsection