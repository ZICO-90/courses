<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class QuestionAnsweUpdateRequest extends FormRequest
{

    protected function isIdForm()
    {
      $encryptedId =   $this->request->get('validation_question_id');

      try {

        $decrypted =Crypt::decrypt($encryptedId);

        return $decrypted;

        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }
        
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $question_id = $this->isIdForm() ;
        $isRulse = [
            'edit_question_'.$question_id => ['required', 'string', 'min:5' , 'max:255'],
            'edit_answer_'.$question_id =>  ['required','array' ,'min:4'] ,
            'edit_answer_'.$question_id . '.*' => ['required',  'string', 'min:5' , 'max:255'],
            'edit_checkbox_answer_' . $question_id  => ['required','array' ,'min:1'],
            
           
        ];
        return $isRulse;
    }
}
