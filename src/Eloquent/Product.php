<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Product extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'sale_price', 'featured_image'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo('CopyaCategory\Eloquent\Category');
    }

    public function orders()
    {
        return $this->morphToMany('CopyaRestaurant\Eloquent\Order', 'orderable');
    }

}
