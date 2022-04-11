<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required',
            'product_name' => 'required|min:8|max:60',
            'product_price' => 'required',
            'sort_desp' => 'required|min:8||max:60',
            'long_desp' => 'required',
            'preview' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Category Id is Requried',
            'product_name.required' => 'Product Name is Requried',
            'product_name.min' => 'Product Name Minimum 8 Character',
            'product_name.max' => 'Product Name Maximum 60 Character',
            'product_price.required' => 'Product Price is Requried',
            'sort_desp.required' => 'Short Description is Requried',
            'sort_desp.min' => 'Short Desp Minimum 8 Character',
            'sort_desp.max' => 'Short Desp Maximum 60 Character',
            'long_desp.required' => 'Long Desp is Requried',
            'preview.required' => 'Product Image is Requrired',

        ];
    }
}
