<div class="up_form-item">
    <h1>عنوان الدورة</h1>
    @error('title')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('title' , null  ,['placeholder' => 'اضف عنوان الدورة' ]) !!}
</div>


<div class="up_form-item">
    <h1>متطلب سابق</h1>
    @error('Previous_requirement')
    <span id="error-form">{{$message}}</span>
    @enderror
   @if(isset($course_dropDownList) && sizeof($course_dropDownList) > 0)
    {!!   Form::select('previous_requirement[]',$course_dropDownList,  null , ['class' => 'form-select'  , 'multiple aria-label' => 'multiple select example' , 'style' => 'height:100px;' ] ) !!}
   @else
   {!!   Form::select('previous_requirement[]', $course_dropDownList ,null , ['class' => 'form-select'  , 'multiple aria-label' => 'multiple select example' , 'style' => 'height:100px;' ] ,[ ' ' => [ "disabled" => true ] ]) !!}

   @endif
</div>

<div class="up_form-item">
    <h1>المجال</h1>
    @error('interest_id')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!!   Form::select('interest_id', $interest_dropDownList,  null, ['class' => 'form-control' ] , [ ' ' => [ "disabled" => true ] ]) !!}
</div>


<div class="up_form-item">
    <h1>رابط فيديو</h1>
    <div class="add_cont text-right">
        <div class="lecture-item">
            <div class="add_cont text-right">

                <label class="text-right">
                    {!! Form::checkbox('up_video' , 1  , null , ['id'=> "up-video" , 'onclick' => "ChooseFileUpVideo()"]) !!}

                   
                    <span>اذا أردت رفع فيديو من جهازك الشخصي</span>
                </label>

                <div class="videoUploaded col-xs-12 text-right" id="videoUploaded">
                    <span><i class="fa fa-video-camera"></i> ارفع فيديو من جهازك</span>
                    @error('file')
                    <span id="error-form">{{$message}}</span>
                    @enderror
                    {!! Form::file('file',['class' => "uploaded"]) !!}
                </div>
               
            </div>

        </div>
        <!-- /.lecture-item -->
    </div>
    @error('url')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('url' , null  ,['placeholder' => 'ادخل رابط فيديو' , 'class' => "linked"  ,'id' => "up-video-input-link"]) !!}
</div>

<div class="up_form-item">
    <h1>وصف الدورة</h1>
    @error('details')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::textarea('details',null ,['placeholder' => "اضف وصف الدورة"]) !!}
</div>




<div class="up_form-item">
    <h1>الجنس المتوقع</h1>
    @error('is_subscribe')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="add_cont text-right">
        <label class="text-right">
            {!! Form::checkbox('is_subscribe[]' ,  1 ) !!}

            <span>ذكور</span>
        </label>
        <label class="text-right">
            {!! Form::checkbox('is_subscribe[]' , 2 ) !!}
            <span>إناث</span>
        </label>
    </div>
</div>


<div class="up_form-item">
    <h1>نوع الدورة</h1>
    @error('case_payment_course')
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="add_cont text-right">
        <label class="text-right"> 

            {!! Form::radio('case_payment_course' , 0 , null , ['id' => "radio-free-coures" , 'onclick' => "ChooseCoursePriceFree()"] ) !!}
           
            <span>مجاني</span>
        </label>
        <label class="text-right">
            {!! Form::radio('case_payment_course' , 1 ,null , ['id' => "radio-not-free-coures" , 'onclick' => "ChooseCoursePriceNotFree()"] ) !!}
         
            <span>مدفوع</span>
        </label>
        @error('course_price')
        <span id="error-form">{{$message}}</span>
        @enderror
        <div class="input-group">
           
         <span class="input-group-addon">$</span>
         {!! Form::text('course_price' , null  ,['class' => 'form-control' ,'onkeypress'=>"return isNumber(event)" , 'id'=> "course-price" ,'aria-label' => "Amount (to the nearest dollar)" , 'data-toggle' => "tooltip"  ,'title' => "" , 'data-original-title' => "اضف سعر الدورة"]) !!}
         <span class="input-group-addon">.00</span>
       </div>
      
    </div>
</div>


<div class="container-fluid">
    <div class='col-md-6'>
    
       <div class="form-group">
       
          <div class='input-group date' dir="rtl"  data-date-format="yyyy-mm-dd"  data-provide="datepicker">
            
             {!! Form::text('end_date' , null  ,['class' => 'form-control' ,'id' => "datepicker" , 'placeholder' => "تاريخ الانتهاء"]) !!}

             <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span>
             </span>
           
          </div>
       </div>
    </div>
    <div class='col-md-6'>
       <div class="form-group">
          <div class='input-group date' name="start_date" data-date-format="yyyy-mm-dd"  data-provide="datepicker">
           
            {!! Form::text('start_date' , null  ,['class' => 'form-control' ,'id' => "datepicker", 'style' => "text-align:right;" , 'placeholder' => "تاريخ البدء"]) !!}
             <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span>
             </span>
            
          </div>
       </div>
    </div>

 </div>
<!-- /.up_form-item -->