<?php

namespace CopyaRestaurant\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaRestaurant\Eloquent\Cuisine;

class CuisineTransformer extends TransformerAbstract
{
    public function transform(Cuisine $cuisine)
    {
        return [
            'id' => (int) $cuisine->id,
            'name' => $cuisine->name,
            'slug' => $cuisine->slug,
            'description' => $cuisine->description,
            'price' => $cuisine->price,
            'sale_price' => $cuisine->sale_price,
            'category_id' => $cuisine->category_id,
            'featured_image' => $cuisine->featured_image
        ];
    }
}