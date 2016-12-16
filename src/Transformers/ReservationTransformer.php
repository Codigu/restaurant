<?php

namespace CopyaRestaurant\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaRestaurant\Eloquent\Reservation;

class ReservationTransformer extends TransformerAbstract
{
    public function transform(Reservation $reservation)
    {
        return [
            'id' => (int) $reservation->id,
            'customer_name' => $reservation->customer_name,
            'email' => $reservation->email,
            'guest_count' => $reservation->guest_count,
            'area_id' => $reservation->area_id,
            'phone' => $reservation->phone,
            'is_agent' => (bool) $reservation->is_agent,
            'amount' => $reservation->amount,
            'discount' => $reservation->discount,
            'deposit' => $reservation->deposit,
            'status_id' => $reservation->status_id,
            'note' => $reservation->note
        ];
    }
}