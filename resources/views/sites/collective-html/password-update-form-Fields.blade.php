
<div class="up_form-item">
    @error('password_old')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">كلمة المرور السابقة</span>
    {!! Form::password('password_old',  ['placeholder' => 'كلمة المرور السابقة']) !!}
    </div>
</div>

<div class="up_form-item">
    @error('password')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">كلمة المرور الجديده</span>
    {!! Form::password('password',  ['placeholder' => 'كلمة المرور الجديده']) !!}
</div>
</div>

<div class="up_form-item">
    @error('password_confirmation')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">إعادة كلمة المرور الجديده</span>
        {!! Form::password('password_confirmation',  ['placeholder' => 'إعادة كلمة المرور الجديده']) !!}
    </div>
</div>
