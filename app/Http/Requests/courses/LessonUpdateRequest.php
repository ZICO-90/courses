<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\Rule;
class LessonUpdateRequest extends FormRequest
{
    protected function isIdForm()
    {
      $encryptedId =   $this->request->get('edit_validation_lesson_id');

      try {

        $decrypted =Crypt::decrypt($encryptedId);

        return $decrypted;

        } catch (DecryptException $e) 
        {
        abort(404,'Not Found');
        }
        
    }

    protected function unique_coures_id()
    {
      $encryptedId =   $this->request->get('edit_validation_course_id');

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
        $id_lesson = $this->isIdForm() ;
        $id_course = $this->unique_coures_id() ;
        $sort = (int) $this->get( 'edit_add_sort_number_'  . $id_lesson);
       
        $isRulse = [

            'edit_lecture_name_'     . $id_lesson  => ['required', 'string', 'min:5' , 'max:255'],
            'edit_file_lecture_'     . $id_lesson  => ['nullable'],
            'edit_up_video_lecture_' . $id_lesson  =>  ['sometimes'],
            'edit_url_lecture_'      . $id_lesson => ['nullable', 'regex:/^(https?:\/\/)?(www\.)?youtube.com\/[a-zA-Z0-9(\.\?)?]/'],
            'edit_lecture_details_'  . $id_lesson  => ['required', 'string', 'min:5' , 'max:65535'],
            'edit_external_link_file_'  . $id_lesson  => ['nullable' ,'url'],
            'edit_add_sort_number_'  . $id_lesson  => ['required'  ,Rule::unique("lessons" ,"sort_display_video")->where(
                function ($query) use ($sort ,$id_course , $id_lesson) {
                    return $query->where(
                        [
                            ["cource_id", "=",  $id_course],
                            ["sort_display_video", "=", $sort]
                        ]
                    );
                })->ignore( $id_lesson) ],
            
               
        ];

        if(!$this->request->has('edit_up_video_lecture_'.$id_lesson ))
        {
            
            $isRulse['edit_url_lecture_'.$id_lesson ] = ['required', 'regex:/^.*((m\.)?youtu\.be\/|vi?\/|u\/\w\/|embed\/|\?vi?=|\&vi?=)([^#\&\?]*).*/'] ;
        }else{
            $isRulse['edit_url_lecture_'.$id_lesson ] = ['nullable'] ;

            
        }
        return $isRulse;
    }
}
