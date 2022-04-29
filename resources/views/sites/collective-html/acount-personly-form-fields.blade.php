
<div class="up_form-item">
    @error('full_name')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">الإسم بالكامل</span>
        {!! Form::text('full_name' , null  ,['placeholder' => 'الإسم بالكامل' ]) !!}
    </div>
</div>

<div class="up_form-item">
       @error('username')
       <span id="error-form">{{$message}}</span>
       @enderror
         <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">إسم المستخدم</span>
              {!! Form::text('username' , null  ,['placeholder' => 'إسم المستخدم' ]) !!}
         </div>   
</div>

<div class="up_form-item">
    
    @error('email')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group alert alert-danger">
        <span class="input-group-addon alert alert-warning" id="basic-addon1">البريد الالكتروني</span>
    {!! Form::email('email', null , ['placeholder' => 'البريد الإلكتروني' , 'class'=> 'error-form' , 'readonly' => true]) !!}
   </div> 
</div>


<div class="up_form-item">
    @error('phone')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">رقم الهاتف</span>
        {!! Form::text('phone' , null  ,['placeholder' => 'رقم الهاتف' ]) !!}
    </div> 
</div>

<div class="up_form-item">
    @error('Employment')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">مجال العمل</span>
        {!! Form::text('Employment' , null , ['placeholder' => 'اختياري' ] ) !!}
    </div>
</div>

<div class="up_form-item">
    @error('qualification')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">المؤهل</span>
        {!! Form::text('qualification' , null , ['placeholder' => 'اختياري' ] ) !!}
    </div>
</div>



<div class="up_form-item">
    @error('Specialization')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">التخصص</span>
        {!! Form::text('Specialization' , null , ['placeholder' => 'اختياري' ] ) !!}
    </div>
</div>


<div class="up_form-item">
    @error('country_id')
    <span id="error-form">{{$message}}</span>
    @enderror

    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">البلد</span>
        {!!   Form::select('country_id',  $country_drop_dwon_list ,  null , ['class' => 'form-control' ]) !!}
    </div> 
   
</div>

<div class="up_form-item">
    @error('gender')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">البلد</span>
       
        {!! Form::select('gender', ['1' => '`ذكر' , '2'=> 'انثي']) !!}
    </div> 
      
</div>



 <!-- /.up_form-item -->
 



