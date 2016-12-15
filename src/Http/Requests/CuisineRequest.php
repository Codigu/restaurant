<?php

namespace CopyaRestaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuisineRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO::enhance security feature
        // check if gate would be applicable here
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
            'name' => 'required',
            'price' => 'numeric|required',
            'sale_price' => 'numeric',
            'category_id' => 'exists:categories,id|required'
        ];
    }
}
