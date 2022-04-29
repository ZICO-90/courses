<div class="up_form-item">
    <h1>عنوان الدورة</h1>
    @error('title')
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('title_'.$item->id , $item->title  ,['placeholder' => 'اضف عنوان الدورة' ]) !!}
</div>


<div class="up_form-item">
    <h1>متطلب سابق</h1>
    @error('Previous_requirement')
    <span id="error-form">{{$message}}</span>
    @enderror
   @if(isset($course_dropDownList) && sizeof($course_dropDownList) > 0)
   @php
    unset($course_dropDownList[$item->title] )
     
   @endphp
    {!!   Form::select('previous_requirement_'.$item->id.'[]',$course_dropDownList,  $item->previous_requirement, ['class' => 'form-select'  , 'multiple aria-label' => 'multiple select example' , 'style' => 'height:100px;' ] ) !!}
   @else
   {!!   Form::select('previous_requirement_'.$item->id.'[]', $course_dropDownList ,$item->previous_requirement , ['class' => 'form-select'  , 'multiple aria-label' => 'multiple select example' , 'style' => 'height:100px;' ] ,[ ' ' => [ "disabled" => true ] ]) !!}

   @endif
</div>

<div class="up_form-item">
    <h1>المجال</h1>
    @error('interest_id_'.$item->id)
    <span id="error-form">{{$message}}</span>
    @enderror
    {!!   Form::select('interest_id_'.$item->id, $interest_dropDownList,  $item->interest_id, ['class' => 'form-control' ] , [ ' ' => [ "disabled" => true ] ]) !!}
</div>


<div class="up_form-item">
    <h1>رابط فيديو</h1>
    <div class="add_cont text-right">
        <div class="lecture-item">
            <div class="add_cont text-right">

                <label class="text-right">
                    {!! Form::checkbox('up_video_'.$item->id , 1  , $item->url_type  == 1 ? true : false , ['id'=> "up-video_".$index_course  , 'onclick' => "ChooseFileUpVideo('up-video_' , 'link-video_' , $index_course , 'videoUploaded_')"]) !!}

                   
                    <span>اذا أردت رفع فيديو من جهازك الشخصي</span>
                </label>

                <div class="videoUploaded col-xs-12 text-right videoUploaded_{{$index_course}} " id="videoUploaded_{{$index_course}}">
                    <span><i class="fa fa-video-camera"></i> ارفع فيديو من جهازك</span>
                    @error('file_'.$item->id)
                    <span id="error-form">{{$message}}</span>
                    @enderror
                    {!! Form::file('file_'.$item->id,['class' => "uploaded"]) !!}
                </div>
               
            </div>

        </div>
        <!-- /.lecture-item -->
    </div>
    @error('url_'.$item->id)
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('url_'.$item->id , $item->url  ,['placeholder' => 'ادخل رابط فيديو' , 'class' => "linked linked_".$index_course  ,'id' => "link-video_".$index_course ]) !!}
    <div class="up_form-item">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$item->youtube_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<div class="up_form-item">
    <h1>وصف الدورة</h1>
    @error('details_'.$item->id)
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::textarea('details_'.$item->id, $item->details,['placeholder' => "اضف وصف الدورة"]) !!}
</div>




<div class="up_form-item">
    <h1>الجنس المتوقع</h1>
    @error('is_subscribe_'.$item->id)
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="add_cont text-right">
        <label class="text-right">
            {!! Form::checkbox('is_subscribe_'.$item->id . '[]' ,  1 , in_array('1' ,$item->is_subscribe ) ? true : false ) !!}

            <span>ذكور</span>
        </label>
        <label class="text-right">
            {!! Form::checkbox('is_subscribe_'.$item->id . '[]' , 2 , in_array('2' ,$item->is_subscribe ) ? true : false) !!}
            <span>إناث</span>
        </label>
    </div>
</div>


<div class="up_form-item">
    <h1>نوع الدورة</h1>
    @error('case_payment_course_'.$item->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="add_cont text-right">
        <label class="text-right"> 

            {!! Form::radio('case_payment_course_'.$item->id , 0 , $item->case_payment_course == 0 ? true: false , ['id' => "free-coures_".$index_course  , 'onclick' => "ChoosePriceFree('free-coures_' , $index_course , 'not-free-coures_' , 'course-price_' )" ] ) !!}
           
            <span>مجاني</span>
        </label>
        <label class="text-right">
            {!! Form::radio('case_payment_course_'.$item->id  , 1 ,$item->case_payment_course == 1 ? true: false , ['id' => "not-free-coures_".$index_course , 'onclick' => "ChoosePriceNotFree('not-free-coures_' , $index_course , 'free-coures_' , 'course-price_' )"] ) !!}
         
            <span>مدفوع</span>
        </label>
        @error('course_price_'.$item->id)
        <span id="error-form">{{$message}}</span>
        @enderror
        <div class="input-group">
           
         <span class="input-group-addon">$</span>
         {!! Form::text('course_price_'.$item->id , $item->course_price  ,['class' => 'form-control' ,'onkeypress'=>"return isNumber(event)" , 'id'=> "course-price_".$index_course ,'aria-label' => "Amount (to the nearest dollar)" , 'data-toggle' => "tooltip"  ,'title' => "" , 'data-original-title' => "اضف سعر الدورة"]) !!}
         <span class="input-group-addon">.00</span>
       </div>
      
    </div>
</div>

<div class="container-fluid">
    @error('end_date_'.$item->id)
    <span id="error-form">{{$message}}</span>
    @enderror
    @error('start_date_'.$item->id)
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class='col-md-6'>
    
       <div class="form-group">
       
          <div class='input-group date' dir="rtl"  data-date-format="yyyy-mm-dd"  data-provide="datepicker">
            
             {!! Form::text('end_date_'.$item->id , $item->end_date  ,[ 'data-date-format' => "yyyy-mm-dd" ,  'class' => 'form-control' ,'id' => "datepicker" , 'placeholder' => "تاريخ الانتهاء"]) !!}

             <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span>
             </span>
           
          </div>
       </div>
    </div>
    <div class='col-md-6'>
       <div class="form-group">
          <div class='input-group date' name="start_date" data-date-format="yyyy-mm-dd"  data-provide="datepicker">
           
            {!! Form::text('start_date_'.$item->id  , $item->start_date ,['data-date-format' => "yyyy-mm-dd" ,'class' => 'form-control' ,'id' => "datepicker", 'style' => "text-align:right;" , 'placeholder' => "تاريخ البدء"]) !!}
             <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span>
             </span>
            
          </div>
       </div>
    </div>

 </div>
<!-- /.up_form-item -->