<?php

namespace CopyaRestaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationTableRequest extends FormRequest
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
            'tables' => 'required|array',
            'tables.*.id' => 'exists:tables,id|required',
        ];
    }
}
