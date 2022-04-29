<div class="add_lecture in-one">

        <div class="lecture-item">
            <h1>اضف السؤال</h1>
            {!! Form::textarea('edit_question_'.$questionItem->id , $questionItem->question ,['placeholder' => 'اكتب سؤالك هنا' ]) !!}
            @error('edit_question_'.$questionItem->id)
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


             
                @error('edit_checkbox_answer_'.$item->id)
                <span id="error-form">{{$message}}</span>
                @enderror
              

                @foreach ($questionItem->QuestionAnswers as $key => $AnswersItem)
                <li>
                    <div class="lecture-item">
                        <span style="color: red;" name="edit_checkbox_value_{{$index_questions}}" id="edit_checkbox_value_{{$index_questions}}">خطأ</span>
                    {!! Form::checkbox('edit_checkbox_answer_'.$questionItem->id .'[]', $key  ,  $AnswersItem->true_false == 1 ? true : false , ['class' => "edit_answer_checkbox_".$index_questions , 'id'=> "edit_answer_checkbox_".$index_questions , 'onclick' => "chooce_answer('edit_answer_checkbox_' , 'edit_checkbox_value_' , $index_questions, this)"]) !!}

                </div>
                    {!! Form::text('edit_answer_'. $questionItem->id. '[]', $AnswersItem->answer,['placeholder' => $array_ansers[$key]]) !!}
                    @if($errors->has('edit_answer_' .$questionItem->id  . '.' .$key ) )
                    <span id="error-form">{{$array_ansers_errors[$key]}}</span>
                    @endif

                </li>
                @endforeach
               
               
               
            </ul>
        </div>
        <input type="hidden" name="validation_question_id" style="display:none;" value="{{Crypt::encrypt($questionItem->id) }}">
      

        <!-- end lecture-item -->
        <div class="lecture-item confirm-lec">
            <input type="submit" value="تعديل الاختبار">
        </div>
       
        <!-- end lecture-item -->

 </div>