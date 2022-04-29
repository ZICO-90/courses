
<div class="right_tap-box col-md-3 col-xs-12 hidden-xs hidden-sm pull-right" style="right: 0px;">
    <div class="right_box-inner">
        <!-- Nav tabs -->
        <a class="toggle-slidenav hidden-xs hidden-sm">
            <i class="fa fa-close"></i>
        </a>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="{{ !empty( request()->route()->parameters(['id']) ) ?  url()->current() == route( 'profile.show.acounts' , request()->route()->parameters(['id']) ) ? 'active' : ''  : ''  }}">

                <a href="{{route('profile.show.acounts' , Crypt::encrypt( auth()->user()->id) )}}" >
                    <i class="fa fa-user"></i> الملف الشخصي
                </a>
            </li>
            
            <li role="presentation" class="{{url()->current() == route('profile.password.reset.show') ? 'active' : ''}}">
                <a href="{{route('profile.password.reset.show')}}">
                    <i class="fa fa-lock"></i> كلمة المرور
                </a>
            </li>
            @if(auth()->guard('web')->user()->is_work === '1' ||  auth()->guard('web')->user()->is_work === '3' )
            <li role="presentation"  class="{{url()->current() == route('profile.course.details') ? 'active' : ''}}">
                <a href="{{route('profile.course.details') }}" aria-controls="courses">
                    <i class="fa fa-database"></i>المدرب / دوراتي
                </a>
            </li>

            <li role="presentation" class="{{url()->current() == route('profile.course.show.cv') ? 'active' : ''}}">
                <a href="{{route('profile.course.show.cv')}}" aria-controls="cv" >
                    <i class="fa fa-file-text-o"></i> السيرة الذاتية
                </a>
            </li>

            @endif
            <li role="presentation" class="{{url()->current() == route('profile.interest.show') ? 'active' : ''}}">
                <a href="{{route('profile.interest.show')}}" aria-controls="interests">
                    <i class="fa fa-diamond"></i> الاهتمامات
                </a>
            </li>
            @if(auth()->guard('web')->user()->is_work === '2' ||  auth()->guard('web')->user()->is_work === '3' )
            <li role="presentation" class="{{url()->current() == route('profile.course.browses') ? 'active' : ''}}">
                <a href="{{route('profile.course.browses') }}" aria-controls="all-courses"  >
                    <i class="fa fa-eye"></i> تصفح الدورات
                </a>
            </li>
            <li role="presentation" class="{{url()->current() == route('profile.course.subscribe') ? 'active' : ''}}">
                <a href="{{route('profile.course.subscribe')}}" aria-controls="my_courses" >
                    <i class="fa fa-folder-open-o"></i> دوراتي كمتدرب
                </a>
            </li>
            <li role="presentation" class="{{url()->current() == route('profile.course.studentShow') ? 'active' : ''}}">
                <a href="{{ route('profile.course.studentShow') }}" aria-controls="my_certf" >
                    <i class="fa fa-table"></i> شهاداتي كمتدرب
                </a>
            </li>
            @endif
           

        </ul>
    </div>
    <!-- /.right_box-inner -->
</div>



<div class="mobile_tap-box col-md-12 col-xs-12 hidden-lg text-center">
    <div class="right_box-inner">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"  class="{{ !empty( request()->route()->parameters(['id']) ) ?  url()->current() == route( 'profile.show.acounts' , request()->route()->parameters(['id']) ) ? 'active' : ''  : ''  }}">

                <a href="{{route('profile.show.acounts' , Crypt::encrypt( auth()->user()->id) )}}"  title="الملف الشخصي">
                    <i class="fa fa-user"></i>
                </a>
            </li>
            <li role="presentation" class="{{url()->current() == route('profile.password.reset.show') ? 'active' : ''}}">
                <a href="{{route('profile.password.reset.show') }}" title="كلمة المرور">
                    <i class="fa fa-lock"></i>
                </a>
            </li>
       
            
            @if(auth()->guard('web')->user()->is_work === '1' ||  auth()->guard('web')->user()->is_work === '3' )

            <li role="presentation" class="{{url()->current() == route('profile.course.details') ? 'active' : ''}}">
                <a href="{{ route('profile.course.details')}}" aria-controls="courses"   title="الدورات">
                    <i class="fa fa-database"></i>
                </a>
            </li>

            <li role="presentation" class="{{url()->current() == route('profile.course.show.cv') ? 'active' : ''}}" >
                <a href="{{ route('profile.course.show.cv') }}" aria-controls="cv"   title="السيرة الذاتية">
                    <i class="fa fa-file-text-o"></i>
                </a>
            </li>

            @endif
          

            <li role="presentation" class="{{url()->current() == route('profile.interest.show') ? 'active' : ''}}">
                <a href="{{route('profile.interest.show')}}" aria-controls="interests"   title="الاهتمامات">
                    <i class="fa fa-diamond"></i>
                </a>
            </li>

        
            @if(auth()->guard('web')->user()->is_work  === '2' ||  auth()->guard('web')->user()->is_work === '3' )

            <li role="presentation"   class="{{url()->current() == route('profile.course.browses') ? 'active' : ''}}" >
                <a href="{{route('profile.course.browses') }}" aria-controls="all-courses"   title="تصفح الدورات">
                    <i class="fa fa-eye"></i>
                </a>
            </li>


            <li role="presentation" class="{{url()->current() == route('profile.course.subscribe') ? 'active' : ''}}">
                <a href="{{route('profile.course.subscribe')}}" aria-controls="my_courses"   title="دوراتي كمتدرب">
                    <i class="fa fa-folder-open-o"></i>
                </a>
            </li>

            <li role="presentation" class="{{url()->current() == route('profile.course.studentShow') ? 'active' : ''}}">
                <a href="{{route('profile.course.studentShow')}}" aria-controls="my_courses"   title="شهاداتي كمتدرب">
                    <i class="fa fa-table"></i>
                </a>
            </li>
            @endif
           
           

        </ul>
    </div>
    <!-- /.right_box-inner -->
</div>
<!-- /.mobile_tap-box -->
