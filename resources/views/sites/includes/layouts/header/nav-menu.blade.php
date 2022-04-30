<nav class="st-menu st-effect-8" id="menu-8">
    <h2 class="icon icon-stack">
        <img src="{{asset('site/assets/images/logo.png')}}" class="img-responsive">
    </h2>
    <ul> 
        <li><a class="icon icon-data" href="{{route('homepage') }}"><i class="glyphicon glyphicon-home"></i> الرئيسية</a></li>
        <li><a id="sd" class="icon icon-location" href="{{route('about')}}"><i class="glyphicon glyphicon-eye-open"></i>من نحن</a></li>
        @if(auth()->guard('web')->check())
          @if(auth()->guard('web')->user()->is_work == 1 ||  auth()->guard('web')->user()->is_work == 3 )
         
            <li><a class="icon icon-data" href="{{route('profile.course.details') }}"><i class="fa fa-database"></i>جميع الدورات</a></li>
            <li><a class="icon icon-photo" href="{{route('profile.course.add')}}"><i class="fa fa-plus"></i>اضافة محاضرة</a></li>
          @endif
        @endif

        <li><a class="icon icon-location" href="{{route('courses.allCourse')}}"><i class="fa fa-rocket"></i>قسم معين</a></li>

        @if(auth()->guard('web')->check())

        @if(auth()->guard('web')->user()->is_work == 2 ||  auth()->guard('web')->user()->is_work == 3 )

        <li><a class="icon icon-study" href="{{ route('profile.course.studentShow') }}"><i class="fa fa-file"></i>شهادة التقدير</a></li>
        @endif

        @endif
        
        @if(auth()->guard('web')->check())
        <li><a class="icon icon-wallet" href="{{route('profile.show.acounts' , Crypt::encrypt( auth()->user()->id) )}}"><i class="fa fa-user"></i>الحساب الشخصي</a></li>
        <li><a class="icon icon-data" href="{{route('profile.password.reset.show')}}"><i class="glyphicon glyphicon-lock"></i>تغير كلمة المرور</a></li>
        @endif
      
        <li><a class="icon icon-photo" href="{{route('contact')}}"><i class="glyphicon glyphicon-exclamation-sign"></i>اتصل بنا</a></li>
    </ul>
</nav>