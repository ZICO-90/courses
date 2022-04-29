<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
   

    protected function isIdForm()
    {
        
        return $this->route('id') ;
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

        $id_cours = $this->isIdForm() ;
       
        $isRulse = [

            'title_' . $id_cours => ['required', 'string', 'min:6' , 'max:255'],
            'previous_requirement_' . $id_cours => ['nullable'],
            'interest_id_' . $id_cours => ['required'],
            'details_' . $id_cours => ['required' ,'min:15'],
            'up_video_' . $id_cours => ['sometimes'],
            'url_' . $id_cours => ['nullable', 'regex:/^(https?:\/\/)?(www\.)?youtube.com\/[a-zA-Z0-9(\.\?)?]/'],
            'start_date_' . $id_cours => ['required' , 'date' ]  ,
            'end_date_' . $id_cours =>  ['required' , 'date', 'after_or_equal:start_date_'.$id_cours]  ,
            'file_' . $id_cours => [ 'nullable'],
            'is_subscribe_' .$id_cours => ['required', 'array', 'min:1'],
            'case_payment_course_' .$id_cours => ['required'],
        
            'course_price_' .$id_cours => ['nullable'],
    
        ];
      
        
        if(!$this->request->has('up_video_' .$id_cours ))
        {
            
            $isRulse['url_' . $id_cours]  = ['required', 'regex:/^.*((m\.)?youtu\.be\/|vi?\/|u\/\w\/|embed\/|\?vi?=|\&vi?=)([^#\&\?]*).*/'] ;
        }

        if($this->request->has('up_video_' .$id_cours ))
        {
            $isRulse['url_' . $id_cours ]  = ['nullable'] ;

            $isRulse['file_' . $id_cours ] = ['nullable'] ;
        }

        if($this->request->has('case_payment_course_' .$id_cours ))
        {
           
            if($this->request->get('case_payment_course_' .$id_cours ) == 1)
            {
                $isRulse['course_price_' . $id_cours ]  =   ['required' ,'min:2' ,'max:6'];
            }
        }
        return $isRulse ;
    }
}
