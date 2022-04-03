<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalledStoreRequest extends FormRequest
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
            'description'=>'required',
            'category'=>'required|exists:categories,id',
            'address'=>'required|exists:addresses,id',

        ];
    }

    public function messages()
    {
        return [            
           
            'description.required' => 'Description is required',
            
            'category.required' => 'Category is required',
            'category.exists' => 'Invalid Category',

            'address.required' => 'Address is required',
            'address.exists' => 'Invalid Address',
          
     
        ];
    }
}
