<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportStoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'registration'=>'required',
        ];
    }

    public function messages()
    {
        return [            
           
            'name.required' => 'Name is required',
            'email.required' => 'E-mail is required',
            'password.required' => 'Password is required',
            'registration.required' => 'Registration is required',
           
                        
     
        ];
    }



}
