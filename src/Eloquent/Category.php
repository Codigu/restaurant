<?php

namespace CopyaRestaurant\Eloquent;

use CopyaCategory\Eloquent\Category as CopyaCategory;
use CopyaRestaurant\Eloquent\Cuisine;
use CopyaRestaurant\Eloquent\Product;


class Category extends CopyaCategory
{
    public function cuisines()
    {
        return $this->hasMany(Cuisine::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
