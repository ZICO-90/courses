

<div class="login-item">
    @error('email')
    <span id="error-form">{{$message}}</span>
    @enderror
    @if(Session::has('verifyEmail'))
    {!! Form::text('email' ,Session::has('verifyEmail') ? Session::get('verifyEmail') : old('email')   ,['placeholder' => 'إسم المستخدم' ]) !!}
   
        
    @else
    {!! Form::text('email' , Cookie::has('email_') ? Cookie::get('email_'): null  ,['placeholder' => 'إسم المستخدم' ]) !!}
    @endif
</div>


<div class="login-item">

    {!!Form::input('password', 'password', Cookie::has('password_') ? Cookie::get('password_'): null , [ 'placeholder' =>'كلمة المرور' ]) !!}
</div>


<div class="login-item">
      <label class="pull-right">
            {{--
              <input type="checkbox" name="remember"   id="remember" {{ old('remember') ? 'checked' : '' }}>
            --}}
        
       
        {!! Form::checkbox('remember', null , Cookie::has('remember_') ? true : false , ['class' => 'styled' ]) !!}

          <span>تذكر كلمة السر دائماً</span>
      </label>

      <label class="pull-left">
          <a href="#"  class="forget">هل نسيت كلمة المرور ؟</a>
      </label>
</div>