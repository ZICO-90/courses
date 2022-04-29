<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class QuestionAnsweAddRequest extends FormRequest
{
    protected function isIdForm()
    {
      $encryptedId =   $this->request->get('validation_course_id');

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
        $id_course = $this->isIdForm() ;
        $isRulse = [
            'question_'.$id_course => ['required', 'string', 'min:5' , 'max:255'],
            'answer_'.$id_course =>  ['required','array' ,'min:4'] ,
            'answer_'.$id_course . '.*' => ['required',  'string', 'min:5' , 'max:255'],
            'checkbox_answer_' . $id_course  => ['required','array' ,'min:1'],
           
        ];
        return $isRulse;
    }
}
