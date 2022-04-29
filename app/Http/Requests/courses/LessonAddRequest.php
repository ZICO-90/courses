<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\Rule;

class LessonAddRequest extends FormRequest
{

    protected function isIdForm()
    {
      $encryptedId =   $this->request->get('validation_lecture_id');

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
     * Get the validation rules that apply to the request. add_sort_number_
     *
     * @return array
     */
    public function rules()
    {

        $id_lesson = $this->isIdForm() ;
        $sort =(int) $this->get( 'add_sort_number_'  . $id_lesson);
     
        $isRulse = [

            'lecture_name_'     .  $id_lesson=> ['required', 'string', 'min:5' , 'max:255'],
            'file_lecture_'     .  $id_lesson => ['nullable'],
            'up_video_lecture_' .  $id_lesson=>  ['sometimes'],
            'url_lecture_'      .  $id_lesson => ['nullable', 'regex:/^(https?:\/\/)?(www\.)?youtube.com\/[a-zA-Z0-9(\.\?)?]/'],
            'lecture_details_'  .  $id_lesson => ['required', 'string', 'min:5' , 'max:65535'],
            'external_link_file_'  .  $id_lesson => ['nullable' ,'url'],
            'add_sort_number_'.  $id_lesson => ['required'  ,Rule::unique("lessons" , 'sort_display_video')->where(
                function ($query) use (  $sort  , $id_lesson) {
                    return $query->where( 
                        [
                            ["cource_id", "=",  $id_lesson],
                            ["sort_display_video", "=",  $sort]
                        ]
                    );
                })],
            
               
        ];

    
        if(!$this->request->has('up_video_lecture_'. $id_lesson))
        {
            
            $isRulse['url_lecture_'. $id_lesson] = ['required', 'regex:/^.*((m\.)?youtu\.be\/|vi?\/|u\/\w\/|embed\/|\?vi?=|\&vi?=)([^#\&\?]*).*/'] ;
        }else{
            $isRulse['file_lecture_'. $id_lesson] = ['required'] ;
        }

        return $isRulse ;
    }
}
