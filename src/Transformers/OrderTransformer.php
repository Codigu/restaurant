<?php

namespace CopyaRestaurant\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaRestaurant\Eloquent\Order;

class OrderTransformer extends TransformerAbstract
{
    public function transform(Order $order)
    {
        return [
            'id' => (int) $order->id,
            'customer_name' => $order->customer_name,
            'phone' => $order->phone,
            'email' => $order->email,
            'amount' => $order->amount,
            'discount' => $order->discount,
            'status_id' => $order->status_id,
            'note' => $order->note
        ];
    }
}
