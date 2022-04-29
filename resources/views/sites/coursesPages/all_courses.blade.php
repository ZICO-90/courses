@extends('sites.layout-site')

@section('title')
عرض جميع الدورات
@endsection



@section('contacts')
<div class="allcourses-box">

@include('sites.includes.layouts.searsh.all_courses_searsh')



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
<div class="allcourses-body">
    <div class="container">
        <div class="row">
            <div class="row block-container" id="row-course">

                @foreach ($all_course as $item)
                <div class="block col-md-4">
                    <figure>
                        <div><img src="/site/assets/images/event_1.jpg" alt="img05" class="img-responsive"></div>
                        <figcaption class="text-right">
                            <h1>
                        <label>اسم الكورس</label>
                        <span>{{$item->title}}</span>
                    </h1>
                            <h1>
                        <label>اسم المدرس</label>
                        <span>{{$item->coures_instructor->username}}</span>
                        
                    </h1>
                            <h1>
                         <label>عدد الطلبة المشتركة</label>
                        <span>{{sizeof($item->studen_course)}}</span>
                        
                    </h1>
                            <h1>
                        <label>تاريخ بداية الكورس</label>
                       
                        @php
                        $getDate =  \Carbon\Carbon::parse(strtotime($item->start_date));
                        @endphp
                        <span id="datepicker" class="datepicker">
                               {{
                                   
                                   $getDate->format('d')     ." " .          $months[ $getDate->format('F')]         
                                }}
        
        
                        </span>
                        
                    </h1>
                            <h1>
                        <label>تقييم الكورس</label>
                        <span>{{$item->degree}} </span>
                        
                    </h1>
                            <a href="{{route('courses.intro' ,Crypt::encrypt($item->id))}}">
                                <i class="fa fa-eye"></i> مشاهدة الكورس
                            </a>
                        </figcaption>
                    </figure>
                </div>
                <!-- /.block -->
                @endforeach

            </div>
            <!-- /.row -->
        </div>
        <!-- /.row -->
      
        {!! $all_course-> links('sites.pagination') !!}
       
        <!-- end inner -->

    </div>
    <!-- /.container -->
</div>
</div>
@endsection

@section('js_course')
<script type="text/javascript">
    $('body').on('keyup' , '#search_input',function(){
        var texetQuery = $(this).val();
      
          
        $.ajax({
            method:'post',
            url: '{{route("courses.search.Ajax")}}',
            dataType:'json',
            data:{
                '_token': '{{csrf_token()}}' ,
                texetQuery : texetQuery 
            },
            success: function(res){
    
                console.log(res)

                var html = '';
    
                $('#row-course').html('');
    
                $.each(res,function(index,value){
                    html = `
                
             <div class="block col-md-4 col-sm-6">
                <figure>
                    <div><img src="/site/assets/images/event_1.jpg" alt="img05" class="img-responsive"></div>
                    <figcaption class="text-right">
                        <h1>
                    <label>اسم الكورس</label>
                    <span>${value.title}</span>
                </h1>
                        <h1>
                    <label>اسم المدرس</label>
                    <span> ${value.coures_instructor.username}</span>
                    
                </h1>
                        <h1>
                     <label>عدد الطلبة المشتركة</label>
                    <span>${value.studen_course.length} </span>
                    
                </h1>
                        <h1>
                    <label>تاريخ بداية الكورس</label>
                   
               
                    <span id="datepicker" class="datepicker">
                   ${ new Date(value.start_date).toLocaleDateString( 'ar-EG',  { day:"numeric", month:"short"})}
    
    
                    </span>
                    
                </h1>
                        <h1>
                    <label>تقييم الكورس</label>
                    <span>${value.degree}</span>
                    
                </h1>
            
                        <a href="{{ URL::to('courses/intro/${value.encrypt_id_ajax}') }}">
                            <i class="fa fa-eye"></i> مشاهدة الكورس
                        </a>
                    </figcaption>
                </figure>
            </div>
          
                    
                    `;
                    $('#row-course').append(html );
                });
            }
    
        });
    
    }); 
    
    
    
    </script>
@endsection