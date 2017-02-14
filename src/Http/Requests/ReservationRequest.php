<?php

namespace CopyaRestaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'reservation.customer_name' => 'required',
            'reservation.email' => 'email',
            'reservation.guest_count' => 'numeric|required',
            'reservation.environment.id' => 'exists:areas,id|required',
            'reservation.phone' => 'required',
            'reservation.discount' => 'numeric',
            'reservation.deposit' => 'numeric',
            'reservation.status_id' => 'exists:statuses,id|nullable',
            'reservation.note' => 'string|nullable',
           // 'reservation.reserved_at' => 'date|required',
            //'reservation.reserved_time' => 'date|required',

            //bag validation
            'bag.*.id' => 'required|exists:cuisines,id',
            'bag.*.quantity' => 'numeric|min:1'
        ];

    }
}
