<div class="{{url()->current() == route('profile.course.add') ? 'course-cert' : ''}}" id="{{url()->current() == route('profile.course.add') ? 'course-cert' : ''}}">
    <div class="up_form-item">
        <h1>إسم الشهادة</h1>
        @error('name')
        <span id="error-form">{{$message}}</span>
        @enderror
        {!! Form::text('name' , null  ,['placeholder' => 'اضف اسم الشهادة' ]) !!}
    </div>
    <!-- /.up_form-item -->
    <div class="up_form-item">
        <h1>الجهة المانحة</h1>
        @error('reference_certif')
        <span id="error-form">{{$message}}</span>
        @enderror
        {!! Form::text('reference_certif' , null  ,['placeholder' => 'اضف الجهة المانحة' ]) !!}
    </div>
    <!-- /.up_form-item -->
    <div class="up_form-item">
        <h1>تكلفة الشهادة</h1>
        @error('case_payment_ertifi')
        <span id="error-form">{{$message}}</span>
        @enderror
        <div class="add_cont text-right">             
            <label class="text-right">
                {!! Form::radio('case_payment_ertifi' , 0 , null , ['id' => "radio-certifi-free" , 'onclick' => "ChooseCertifiPriceFree()"] ) !!}
                <span>مجاني</span>
            </label>
            <label class="text-right">
                {!! Form::radio('case_payment_ertifi' , 1 , null , ['id' => "radio-certifi-not-free" , 'onclick' => "ChooseCertifiPriceNotFree()"] ) !!}
                <span>مدفوع</span>
            </label>
            @error('certifi_price')
            <span id="error-form">{{$message}}</span>
            @enderror
            <div class="input-group">
             <span class="input-group-addon">$</span>
             {!! Form::text('certifi_price' , null  ,['class' => 'form-control' ,'onkeypress'=>"return isNumber(event)" , 'id'=> "certifi-price" ,'aria-label' => "Amount (to the nearest dollar)" , 'data-toggle' => "tooltip"  ,'title' => "" , 'data-original-title' => "اضف سعر الشهاده"]) !!}

             <span class="input-group-addon">.00</span>
           </div>
        </div>
        <!-- /.up_form-item -->
    </div>
    <!-- /.course-cert -->
</div>