<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [          
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'ssn'=>'required',
            'phone'=>'required',
            'street'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip_code'=>'required',
            'country'=>'required',           
          
        ];
    }

    public function messages()
    {
        return [            
           
            'name.required' => 'Name is required',
            'email.required' => 'E-mail is required',
            'password.required' => 'Password is required',
            'ssn.required' => 'SSN is required',
            'phone.required' => 'Phone is required',
            'street.required' => 'Street is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'zip_code.required' => 'Zip Code is required',
            'country.required' => 'Country is required',
                        
     
        ];
    }
}
