<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'is_agent',
        'amount',
        'discount',
        'note'
    ];

    public function status()
    {
        return $this->belongsTo('CopyaRestaurant\Eloquent\Status');
    }
}
