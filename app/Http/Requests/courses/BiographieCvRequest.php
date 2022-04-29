<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;

class BiographieCvRequest extends FormRequest
{

    protected  $isRulse = [

        'biography_link' => ['nullable', 'url', 'min:6' , 'max:255'],
        'biography' => ['nullable' ,'min:6' , 'max:65535'] ,
       

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

        if( empty( $this->request->get('biography_link') ) &&  empty( $this->request->get('biography') ) )
        {
            $this->isRulse['biography_link'] =   ['required', 'url', 'min:6' , 'max:255'];
            $this->isRulse['biography'] =        ['required' , 'min:6' , 'max:65535'] ;
        }
        
     
    
  
        return $this->isRulse;
    }
}
