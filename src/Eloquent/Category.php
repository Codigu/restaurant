<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use CopyaCategory\Eloquent\Category as CopyaCategory;
use CopyaRestaurant\Eloquent\Cuisine;


class Category extends CopyaCategory
{
    public function cuisines()
    {
        return $this->hasMany(Cuisine::class);
    }
}
