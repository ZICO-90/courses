<div class="lecture-item">
    <h1>اسم الدرس</h1>
    @error('lecture_name_'.$item->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('lecture_name_'.$item->id , null ,['placeholder' => 'اضف اسم المحاضرة' ]) !!}

</div>
<!-- /.lecture-item -->
<div class="lecture-item">
    <h1>اضف رابط خارجي للفيديو</h1>
    @error('up_video_lecture_'.$item->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="add_cont text-right">
        <label class="text-right">
            {!! Form::checkbox('up_video_lecture_'.$item->id , 1  , null , ['id'=> "up-video_lecture_".$index_course  , 'onclick' => "ChooseFileUpVideoTwo('up-video_lecture_' , 'link-video_lecture_' , $index_course, 'lecture_videoUploaded_' , this )"]) !!}

            <span>اذا أردت رفع فيديو من جهازك الشخصي</span>
        </label>

        <div class="videoUploaded col-xs-12 text-right lecture_videoUploaded_{{$index_course}}" id="lecture_videoUploaded_{{$index_course}}">
            <span><i class="fa fa-video-camera"></i> ارفع فيديو من جهازك</span>
         
            {!! Form::file('file_lecture_'.$item->id,['class' => "uploaded"]) !!}
            @error('file_lecture_'.$item->id )
            <span id="error-form">{{$message}}</span>
            @enderror
        </div>
   
    </div>
    @error('url_lecture_'.$item->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('url_lecture_'.$item->id , null ,['placeholder' => 'ادخل رابط فيديو' , 'class' => "linked lecture_linked_".$index_course ,'id' => "link-video_lecture_".$index_course ]) !!}

</div>
<!-- /.lecture-item -->
<div class="lecture-item">
    <h1>اسم الدرس</h1>
    @error('lecture_details_'.$item->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::textarea('lecture_details_'.$item->id , null ,['placeholder' => 'اضف وصف المحاضرة' ]) !!}

</div>
<!-- /.lecture-item -->

<div class="lecture-item">
    <h1>رابط أوراق العمل</h1>
    @error('external_link_file_'.$item->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('external_link_file_'.$item->id , null ,['placeholder' => 'رابط اوراق العمل ' ]) !!}
    <span class="hint"> Image او Word او Powerpoint او Pdf رابط أوراق العمل يمكن ان تكون </span>

</div>
<!-- /.lecture-item -->
<div class="lecture-item add-sorting">
    <label>
        @error('add_sort_number_'.$item->id )
        <span id="error-form">{{$message}}</span>
        @enderror
        <span>يجب تحديد ترتيب الدرس </span>
    
        {!! Form::number('add_sort_number_'.$item->id , null ,['step' => '1' ,'onkeypress'=>"return isNumber(event)" , 'onchange' => "this.value = Math.max(1, Math.min(300, parseInt(this.value)));" , 'data-toggle' => "tooltip"  , "data-placement" => 'top' , 'class' => 'add_sort-number' , 'data-original-title' => 'اكتب ترتيب الدرس بالأرقام']) !!}

    </label>
</div>
<input type="hidden" name="validation_lecture_id" style="display:none;" value="{{Crypt::encrypt($item->id) }}">

<!-- /.lecture-item -->
<div class="lecture-item confirm-lec">
    <input type="submit" value="إضافة محاضرة">
</div>
<!-- /.lecture-item -->