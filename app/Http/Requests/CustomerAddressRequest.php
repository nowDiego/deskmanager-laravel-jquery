<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
            'street'=>'required|max:255',
            'city'=>'required|max:255',
            'state'=>'required|max:255',
            'zip_code'=>'required|max:255',
            'country'=>'required|max:255',
           

        ];
    }

    public function messages()
    {
        return [            
            'street.required' => 'Street is required',
            'street.max'=>'You have exceeded the maximum number of 255 characters in this field',                   
          
            'city.required' => 'City is required',
            'city.max'=>'You have exceeded the maximum number of 255 characters in this field',                   
          
            'state.required' => 'State is required',
            'state.max'=>'You have exceeded the maximum number of 255 characters in this field',                   
          
            'zip_code.required' => 'Zip code is required',
            'zip_code.max'=>'You have exceeded the maximum number of 255 characters in this field',                   
          
            'country.required' => 'Country is required',
            'country.max'=>'You have exceeded the maximum number of 255 characters in this field',                   
          
           
          
     
        ];
    }
}
