<div class="container">
    <div class="courses-head text-center">
        <h1>أحدث الكورسات</h1>
    </div>
    <!-- /.testominal-head -->
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

    <div class="row block-container" id="row-course">

        @foreach ($lasts_course as $item)
       
         <!-- /.block -->
         <div class="block col-md-4 col-sm-6">
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
                    <a href="{{route('courses.intro' ,Crypt::encrypt($item->id) )}}">
                        <i class="fa fa-eye"></i> مشاهدة الكورس
                    </a>
                </figcaption>
            </figure>
        </div>
        <!-- /.block -->
      
            
        @endforeach
     
       


    </div>
    <!-- /.row -->

    <div class="all-courses text-center">
        <a href="{{route('courses.allCourse')}}">عرض جميع الكورسات</a>
    </div>
    <!-- /.all-courses -->

</div>