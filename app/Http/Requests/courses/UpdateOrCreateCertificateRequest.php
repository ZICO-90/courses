<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UpdateOrCreateCertificateRequest extends FormRequest
{
    protected function isIdForm()
    {
      $encryptedId =   $this->request->get('validation_certifi_id');

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

        
        $isRulse = [

            'name_' . $this->isIdForm() => ['required', 'string', 'min:5' , 'max:255'],
            'reference_certif_' . $this->isIdForm() =>  ['required', 'string', 'min:5' , 'max:255'],
            'case_payment_ertifi_' . $this->isIdForm() => ['required'],
            'certifi_price_' . $this->isIdForm() => ['nullable'],
            
               
        ];

        if($this->request->get('case_payment_ertifi_' . $this->isIdForm()) == 1)
        {
            $isRulse['certifi_price_' . $this->isIdForm()] =  ['required' ,'min:2' ,'max:6'];
        }
        return $isRulse;
    }
}
