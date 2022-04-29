<div class="lecture-item">
    <h1>اسم الدرس</h1>
    @error('edit_lecture_name_'.$lesson->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('edit_lecture_name_'.$lesson->id , $lesson->name ,['placeholder' => 'اضف اسم المحاضرة' ]) !!}

</div>
<!-- /.lecture-item -->
<div class="lecture-item">
    <h1>اضف رابط خارجي للفيديو</h1>
    @error('edit_up_video_lecture_'.$lesson->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    <div class="add_cont text-right">
        <label class="text-right">
            {!! Form::checkbox('edit_up_video_lecture_'.$lesson->id , 1  , $lesson->url_type  == 1 ? true : false , ['id'=> "edit_up-video_lecture_".$index_course , 'class' => "edit_up-video_lecture_".$index_course   , 'onclick' => "ChooseFileUpVideo('edit_up_video_lecture_' , 'edit_url_lecture_' , $lesson->id, 'edit_lecture_videoUploaded_' , this )"]) !!}

            <span>اذا أردت رفع فيديو من جهازك الشخصي</span>
        </label>

        <div name="edit_lecture_videoUploaded_{{$lesson->id}}" class="videoUploaded col-xs-12 text-right edit_lecture_videoUploaded_{{$index_course}}" id="edit_lecture_videoUploaded_{{$index_course}}">
            <span><i class="fa fa-video-camera"></i> ارفع فيديو من جهازك</span>
         
            {!! Form::file('edit_file_lecture_'.$lesson->id,['class' => "uploaded"]) !!}
            @error('edit_file_lecture_'.$lesson->id )
            <span id="error-form">{{$message}}</span>
            @enderror
        </div>
   
    </div>
    @error('edit_url_lecture_'.$lesson->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('edit_url_lecture_'.$lesson->id , $lesson->url_video ,['placeholder' => 'ادخل رابط فيديو' , 'class' => "linked edit_lecture_linked_".$index_course   ,'id' => "edit_link-video_lecture_".$index_course  ]) !!}

</div>
<!-- /.lecture-item -->
<div class="lecture-item">
    <h1>اسم الدرس</h1>
    @error('edit_lecture_details_'.$lesson->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::textarea('edit_lecture_details_'.$lesson->id , $lesson->detalis ,['placeholder' => 'اضف وصف المحاضرة' ]) !!}

</div>
<!-- /.lecture-item -->

<div class="lecture-item">
    <h1>رابط أوراق العمل</h1>
    @error('edit_external_link_file_'.$lesson->id )
    <span id="error-form">{{$message}}</span>
    @enderror
    {!! Form::text('edit_external_link_file_'.$lesson->id , $lesson->external_link_file ,['placeholder' => 'رابط اوراق العمل ' ]) !!}
    <span class="hint"> Image او Word او Powerpoint او Pdf رابط أوراق العمل يمكن ان تكون </span>

</div>
<!-- /.lecture-item -->
<div class="lecture-item add-sorting">
    <label>
        @error('edit_add_sort_number_'.$lesson->id )
        <span id="error-form">{{$message}}</span>
        @enderror
        <span>يجب تحديد ترتيب الدرس </span>
    
        {!! Form::number('edit_add_sort_number_'.$lesson->id , $lesson->sort_display_video ,['step' => '1' ,'onkeypress'=>"return isNumber(event)" , 'onchange' => "this.value = Math.max(1, Math.min(300, parseInt(this.value)));" , 'data-toggle' => "tooltip"  , "data-placement" => 'top' , 'class' => 'add_sort-number' , 'data-original-title' => 'اكتب ترتيب الدرس بالأرقام']) !!}

    </label>
</div>
<input type="hidden" name="edit_validation_lesson_id" style="display:none;" value="{{Crypt::encrypt($lesson->id) }}">

<input type="hidden" name="edit_validation_course_id" style="display:none;" value="{{Crypt::encrypt($lesson->cource_id) }}">

<!-- /.lecture-item -->
<div class="lecture-item confirm-lec">
    <input type="submit" value="تعديل المحاضرة">
</div>
<!-- /.lecture-item -->