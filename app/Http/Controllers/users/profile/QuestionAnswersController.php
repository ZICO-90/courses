<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\courses\QuestionAnsweAddRequest;
use App\Http\Requests\courses\QuestionAnsweUpdateRequest;

use Illuminate\Support\Facades\DB;
use App\Models\Question;

class QuestionAnswersController extends Controller
{
    public function QuestionAnswerAdd(QuestionAnsweAddRequest  $request)
    {
       
        $encryptedId_coures_id = \Illuminate\Support\Facades\Crypt::decrypt($request->validation_course_id);

        $question_answer_array =array(); 
        foreach($request['answer_'.$encryptedId_coures_id ] as $key => $item)
        {
            if( in_array($key , $request['checkbox_answer_'.$encryptedId_coures_id] ) )
               array_push($question_answer_array  , ['answer' =>  $item , 'true_false' => 1  ] );
             else
               array_push($question_answer_array  , ['answer' =>  $item , 'true_false' => 0  ] );
        }


        try{
            DB::beginTransaction();

            $role_question = [
                'question'  => $request['question_'.$encryptedId_coures_id ] ,
                'cource_id' =>  $encryptedId_coures_id ,

            ];

          $get_question =   Question::create($role_question);


          $get_question->QuestionAnswers()->createMany( $question_answer_array);

            DB::commit();

            return back()->with(['info' => 'تمت اضافة الاختبار بنجاح']);     


        }catch(\Exception $ex)
        {
            DB::rollback();
            return back()->with(['error' => 'حدث مشكلة ما برجاء إعادة المحاوله في وقت لاحق']);   
        }
       
     }
     public function QuestionAnswerUpdate(QuestionAnsweUpdateRequest $request )
     {
        $encryptedId_question_id = \Illuminate\Support\Facades\Crypt::decrypt($request->validation_question_id);


       $Question_update =  Question::findOrFail($encryptedId_question_id);

        $question_answer_array =array(); 
        foreach($request['edit_answer_'.$encryptedId_question_id ] as $key => $item)
        {
            if( in_array($key , $request['edit_checkbox_answer_'.$encryptedId_question_id] ) )
               array_push($question_answer_array  , ['answer' =>  $item , 'true_false' => 1  ] );
             else
               array_push($question_answer_array  , ['answer' =>  $item , 'true_false' => 0  ] );
        }

      


        try{
            DB::beginTransaction();

            $role_question = [
                'question'  => $request['edit_question_'.$encryptedId_question_id ] ,
                

            ];

          $get_question =  $Question_update->update($role_question);



         $question_answers=  $Question_update->QuestionAnswers()->get();


         for ($i = 0; $i  < sizeof($question_answers); $i ++) { 

            if($question_answers[$i]->answer !==  $question_answer_array[$i ]['answer'] ||  $question_answers[$i]->true_false !==  $question_answer_array[$i]['true_false'] )
              {
                  
                $question_answers[$i]->answer  = $question_answer_array[$i]['answer']  ;
                $question_answers[$i]->true_false  = $question_answer_array[$i]['true_false'];
                $question_answers[$i]->save();
              }
            
         }
         

            DB::commit();

            return back()->with(['info' => 'تمت تعديل الاختبار بنجاح']);     


        }catch(\Exception $ex)
        {

            DB::rollback();
            return back()->with(['error' => 'حدث مشكلة ما برجاء إعادة المحاوله في وقت لاحق']);   
        }
       
       
     }

     public function allDeleteQuestion($DeletdId) // with delete relation 
     {
        
 
        try {
  
          $decrypted = \Illuminate\Support\Facades\Crypt::decrypt($DeletdId);
  
          $Question_update =  Question::findOrFail($decrypted)->delete();
          return back()->with(['info' => 'تمت عملية حذف الاختبار بنجاح']);  
  
          } catch (\Illuminate\Contracts\Encryption\DecryptException $ex) 
          {
          abort(404,'Not Found');
          }   
      
     }
}
