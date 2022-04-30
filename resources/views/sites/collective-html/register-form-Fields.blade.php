
<div class="up_form-item">
    @error('full_name')
    <span id="error-form">{{$message}}</span>
    @enderror

    {!! Form::text('full_name' , null  ,['placeholder' => 'الإسم بالكامل' ]) !!}
</div>

<div class="up_form-item">
    @error('username')
    <span id="error-form">{{$message}}</span>
    @enderror

    {!! Form::text('username' , null  ,['placeholder' => 'إسم المستخدم' ]) !!}
</div>

<div class="up_form-item">
    
    @error('email')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::email('email', null , ['placeholder' => 'البريد الإلكتروني' ]) !!}

</div>


<div class="up_form-item">
    @error('password')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::password('password',  ['placeholder' => 'كلمة المرور']) !!}

</div>

<div class="up_form-item">
    @error('confirm_password')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::password('password_confirmation',  ['placeholder' => 'إعادة كلمة المرور']) !!}

</div>





<div class="up_form-item">
    @error('phone')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('phone' , null  ,['placeholder' => 'رقم الهاتف' ]) !!}
</div>


<div class="up_form-item">
    @error('country_id')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!!   Form::select('country_id',  $country

    ,  null , ['class' => 'form-control'  , 'data-old' =>  old('country_id')] ,
      [ '' => [ "disabled" => true ] ] ) !!}
</div>

<div class="up_form-item">
    @error('gender')
    <span id="error-form">{{$message}}</span>
    @enderror
 
      {!! Form::select('gender', ['1' => 'ذكر', '2' => 'انثي' , ' ' => 'الجنس..'], ' ') !!}
</div>



 <!-- /.up_form-item -->
 <div class="up_form-item text-right">
    @error('at_least_one')
    <span id="error-form">{{$message}}</span>
    @enderror
    <label>
        {!! Form::checkbox('instructor', '1') !!}
        <span>مدرب</span>
        <a   data-toggle="modal" class="privacy" data-target="#teacher" >تعرف علي سياسة الخصوصية كمدرب</a>
    </label>
    <label>
        
        {!! Form::checkbox('student', '2') !!}
        <span>متدرب</span>
        <a  data-toggle="modal" class="privacy"  data-target="#sudents" >تعرف علي سياسة الخصوصية كمتدرب</a>
    </label>
</div>
<!-- /.up_form-item -->
<div class="policy text-right">
    @error('policy')
    <span id="error-form">{{$message}}</span>
    @enderror
    <label class="text-right policy">
        {!! Form::checkbox('policy', '1') !!}
        <span>هل انت موافق علي سياسة الخصوصية</span>
    </label>
</div>


