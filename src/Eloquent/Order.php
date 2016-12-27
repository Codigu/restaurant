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

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function cuisines()
    {
        return $this->morphedByMany('CopyaRestaurant\Eloquent\Cuisine', 'orderable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function products()
    {
        return $this->morphedByMany('CopyaRestaurant\Eloquent\Product', 'orderable');
    }
}
