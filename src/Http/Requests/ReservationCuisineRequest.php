<?php

namespace CopyaRestaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationCuisineRequest extends FormRequest
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
        if($this->method() == 'POST'){
            return [
                'cuisine_id' => 'exists:cuisines,id|required',
                'quantity' => 'integer|numeric|min:1'
            ];
        } else if($this->method() == "PUT"){
            return [
                'quantity' => 'integer|numeric|min:1'
            ];
        }

    }
}
