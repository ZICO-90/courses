<div class="add_lecture in-one">

        <div class="lecture-item">
            <h1>اضف السؤال</h1>
            {!! Form::textarea('question_'.$item->id , null ,['placeholder' => 'اكتب سؤالك هنا' ]) !!}
            @error('question_'.$item->id)
            <span id="error-form">{{$message}}</span>
            @enderror
        </div>
        <!-- end lecture-item -->

        <div class="lecture-item">
            <h1>يجب عليك اختيار اجابة صحيحة واحده</h1>
            <ul>
                @php
                    $array_ansers = [
                        '0' => "اكتب الاجابة الاولي"   ,
                        '1' => "اكتب الاجابة الثانية" ,
                        '2' => "اكتب الاجابة الثالثة" ,
                        '3' => "اكتب الاجابة الرابعة",
                    ] ;

                    $array_ansers_errors = [
                        '0' => "الاجابة الاولي مطلوبه"   ,
                        '1' => "الاجابة الثانية مطلوبه" ,
                        '2' => "الاجابة الثالثة مطلوبه" ,
                        '3' => "الاجابة الرابعه مطلوبه",
                    ] ;
                  
                @endphp


             
                @error('checkbox_answer_'.$item->id)
                <span id="error-form">{{$message}}</span>
                @enderror
                @for($i = 0  ; $i < 4 ; $i++)
                <li>
                    <div class="lecture-item">
                        <span style="color: red;" name="checkbox_value_{{$index_course }}" id="checkbox_value_{{$index_course }}">خطأ</span>
                    {!! Form::checkbox('checkbox_answer_'.$item->id .'[]', $i  , null, ['class' => "answer_checkbox_".$index_course , 'id'=> "answer_checkbox_".$index_course , 'onclick' => "chooce_answer('answer_checkbox_' , 'checkbox_value_' , $index_course , this)"]) !!}

                </div>
                    {!! Form::text('answer_'. $item->id. '[]', null,['placeholder' => $array_ansers[$i]]) !!}
                    @if($errors->has('answer_' .$item->id  . '.' .$i ) )
                    <span id="error-form">{{$array_ansers_errors[$i]}}</span>
                    @endif
                   
                </li>
                @endfor
               
            </ul>
        </div>
        <input type="hidden" name="validation_course_id" style="display:none;" value="{{Crypt::encrypt($item->id) }}">

        <!-- end lecture-item -->
        <div class="lecture-item confirm-lec">
            <input type="submit" value="نشر الاختبار">
        </div>
        <!-- end lecture-item -->

 </div>