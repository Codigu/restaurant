<?php

namespace CopyaRestaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationSessionRequest extends FormRequest
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
            'email' => 'email',
            'guest_count' => 'numeric|required',
            'area_id' => 'exists:areas,id|required',
            'discount' => 'numeric',
            'deposit' => 'numeric',
            'status_id' => 'exists:statuses,id|nullable',
            'note' => 'string|nullable',
            'reserved_at' => 'date|required'
        ];
    }
}
