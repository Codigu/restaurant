<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $table = 'reservations';
    protected $fillable = [
        'customer_name',
        'email',
        'guest_count',
        'phone',
        'is_agent',
        'amount',
        'discount',
        'deposit',
        'note'
    ];

    public function area()
    {
        return $this->belongsTo('CopyaRestaurant\Eloquent\Area');
    }

    public function status()
    {
        return $this->belongsTo('CopyaRestaurant\Eloquent\Status');
    }

    public function tables()
    {
        return $this->belongsToMany('CopyaRestaurant\Eloquent\Table');
    }

    public function cuisines()
    {
        return $this->belongsToMany('CopyaRestaurant\Eloquent\Cuisine');
    }
}
