<div class="course-cert_" id="course-cert_">
    <div class="up_form-item">
        <h1>إسم الشهادة</h1>
        @error('name_'.$item->id )
        <span id="error-form">{{$message}}</span>
        @enderror
        {!! Form::text('name_'.$item->id  , ! is_null($item->Certificate) ?  $item->Certificate->name : null   ,['placeholder' => 'اضف اسم الشهادة' ]) !!}
    </div>
    <!-- /.up_form-item -->
    <div class="up_form-item">
        <h1>الجهة المانحة</h1>
        @error('reference_certif_'.$item->id )
        <span id="error-form">{{$message}}</span>
        @enderror
        {!! Form::text('reference_certif_'.$item->id  , ! is_null($item->Certificate) ?  $item->Certificate->reference_certif : null   ,['placeholder' => 'اضف الجهة المانحة' ]) !!}
    </div>
    <!-- /.up_form-item -->
    <div class="up_form-item">
        <h1>تكلفة الشهادة</h1>
        @error('case_payment_ertifi_'.$item->id )
        <span id="error-form">{{$message}}</span>
        @enderror
        <div class="add_cont text-right">             
            <label class="text-right">
                {!! Form::radio('case_payment_ertifi_'.$item->id  , 0 , ! is_null($item->Certificate) ?  $item->Certificate->case_payment == 0 ? true : false  : null , ['id' => "certifi-free_".$index_course, 'onclick' => "ChoosePriceFree('certifi-free_' , $index_course, 'certifi-not-free_' , 'certifi-price_' )"] ) !!}
                <span>مجاني</span>
            </label>
            <label class="text-right">
                {!! Form::radio('case_payment_ertifi_'.$item->id  , 1 , ! is_null($item->Certificate) ?  $item->Certificate->case_payment == 1 ? true : false  : null  , ['id' => "certifi-not-free_".$index_course , 'onclick' => "ChoosePriceNotFree('certifi-not-free_' , $index_course, 'certifi-free_', 'certifi-price_')"] ) !!}
                <span>مدفوع</span>
            </label>
            @error('certifi_price_'.$item->id )
            <span id="error-form">{{$message}}</span>
            @enderror
            <div class="input-group">
             <span class="input-group-addon">$</span>
             {!! Form::text('certifi_price_'.$item->id , ! is_null($item->Certificate) ?  $item->Certificate->certifi_price  : null  ,['class' => 'form-control' ,'onkeypress'=>"return isNumber(event)" , 'id'=> "certifi-price_".$index_course,'aria-label' => "Amount (to the nearest dollar)" , 'data-toggle' => "tooltip"  ,'title' => "" , 'data-original-title' => "اضف سعر الشهاده"]) !!}

             <span class="input-group-addon">.00</span>
           </div>
        </div>
        <!-- /.up_form-item -->
    </div>
    <!-- /.course-cert -->
  
    <input type="hidden" name="validation_certifi_id" style="display:none;" value="{{Crypt::encrypt($item->id) }}">
</div>