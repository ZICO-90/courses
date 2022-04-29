<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<meta charset="utf-8">

	<title>تسجيل دخول المسؤول</title>

	<!-- Global stylesheets -->
    @include('dashboardAdmins.layouts.includes.head-link')
	<!-- /global stylesheets -->

	

</head>

<body class="login-container bg-slate-800">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->

                        {!! Form::open(['route' => ['login.admin'] , 'method' => 'POST']) !!}
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
								<h5 class="content-group-lg"> تسجيل الدخول إلى حساب المسؤول <small class="display-block">أدخل بيانات الاعتماد الخاصة بك</small></h5>
							</div>
                           

							<div class="form-group has-feedback has-feedback-left">
                                {!! Form::email('email', Cookie::has('email') ? Cookie::get('email'): null, ['class' => "form-control"  , 'placeholder' => "البريج الالكتروني" ]) !!}
							
                                
                                
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
							
                               
                                {!!Form::input('password', 'password', Cookie::has('password') ? Cookie::get('password'): null , ['class' => 'form-control' , 'placeholder' =>'كلمة المرور' ]) !!}
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
										
                                            {!! Form::checkbox('remember', null , Cookie::has('remember') ? true : false, ['class' => 'styled' ]) !!}
											Remember
										</label>
									</div>

									<div class="col-sm-6 text-right">
										<a href="login_password_recover.html">Forgot password?</a>
									</div>
								</div>
							</div>

                            <div class="form-group">
								<button type="submit" class="btn bg-blue btn-block">دخول <i class="icon-circle-left2 position-right"></i></button>
							</div>
				
                            {!! Form::close() !!}
					<!-- /advanced login -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
