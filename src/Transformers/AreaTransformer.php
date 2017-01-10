<?php

namespace CopyaRestaurant\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaRestaurant\Eloquent\Area;

class AreaTransformer extends TransformerAbstract
{
    public function transform(Area $area)
    {
        return [
            'id' => (int) $area->id,
            'name' => $area->name,
            'slug' => $area->slug,
            'description' => $area->description,
            'smoking' => (bool) $area->smoking,
        ];
    }
}