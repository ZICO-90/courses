<div class="signup-area">
    @include('sites.includes.alerts.errors')
    @include('sites.includes.alerts.success')
    <div class="container">
        <div class="login-form col-md-6 col-xs-12 text-right pull-right">
            <h1>تسجيل الدخول</h1>
            <form action="{{route('login.logins')}}" method="POST">
                       @csrf
                    
                      @include('sites.collective-html.login-form-fields')
                     <!-- /.login-item -->
       
                        <div class="login-item">
                            <input type="submit" value="دخول">
                        </div>
                   <!-- /.login-item -->
            </form>
        </div>
        <!-- /.login-form -->

        <div class="signup-form col-md-6 col-xs-12 text-right">
            <h1>تسجيل عضوية جديدة</h1>
            <p>اذا كنت مستخدم جديد لموقعنا فيمكنك ان تتصفح معظم الكورسات الموجودة الان امامك ولكن لن تستطيع الحصول علي معلومات الكورس او الاشتراك به الا اذا كنت تمتلك حساب لدينا لذلك تستطيع تسجيل حساب جديد من هنا </p>
            <a href="{{route('register.create')}}">
                <i class="fa fa-user-plus"></i> تسجيل عضوية
            </a>
        </div>
        <!-- /.signup-form -->

        <!-- =========================================================================================================================================== -->

        <div class="panel-pop modal" id="forget">
            <div class="lost-inner">
                <h1>هل نسيت كلمة المرور ؟</h1>
                <div class="lost-item">
                    <input type="text" placeholder="الايميل المستخدم في تسجيل الدخول">
                </div>
                <!-- /.lost-item -->
                <div class="text-center">
                    <input type="submit" value="إعادة ضبط">
                </div>
                <!-- /.lost-item -->
            </div>
            <!-- /.lost-inner -->
        </div>
        <!-- /.modal -->

        <!-- =========================================================================================================================================== -->

    </div>
    <!-- /.container -->
</div>
<!-- /.login-area -->