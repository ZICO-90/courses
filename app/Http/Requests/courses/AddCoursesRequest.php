<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;

class AddCoursesRequest extends FormRequest
{


    protected  $isRulse = [

        'title' => ['required', 'string', 'min:6' , 'max:255'],
        'start_date' => ['required' ,'date'] ,
        'end_date' =>  ['required' ,'date' , 'after_or_equal:start_date'] ,
        'previous_requirement' => ['nullable'],
        'interest_id' => ['required'],
        'details' => ['required' ,'min:15'],
        'up_video' => ['sometimes'],
        'url' => ['nullable', 'regex:/^(https?:\/\/)?(www\.)?youtube.com\/[a-zA-Z0-9(\.\?)?]/'],
        'file' => [ 'required_if:up_video,1'],
        'is_subscribe' => ['required', 'array', 'min:1'],
        'case_payment_course' => ['required'],
    
        'course_price' => ['nullable'],

    ];

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
        if(!$this->request->has('up_video'))
        {
            
            $this->isRulse['url'] = ['required', 'regex:/^.*((m\.)?youtu\.be\/|vi?\/|u\/\w\/|embed\/|\?vi?=|\&vi?=)([^#\&\?]*).*/'] ;
        }

        if($this->request->has('case_payment_course'))
        {
           
            if($this->request->get('case_payment_course') == 1)
            {
                $this->isRulse['course_price'] =   ['required' ,'min:2' ,'max:6'];
            }
        }


        if($this->request->has('add_cert'))
        {
            $this->isRulse['name'] =    ['required', 'string', 'min:5' , 'max:255'];
            $this->isRulse['reference_certif'] =   ['required', 'string', 'min:5' , 'max:255'];
            $this->isRulse['case_payment_ertifi'] =  ['required'];
            $this->isRulse['certifi_price'] =  ['nullable'];

            if($this->request->get('case_payment_ertifi') == 1)
            {
                $this->isRulse['certifi_price'] =  ['required' ,'min:2' ,'max:6'];
            }

        }
       
        return $this->isRulse ;
    }
}
