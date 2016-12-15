<?php

namespace CopyaRestaurant\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaRestaurant\Eloquent\Table;

class TableTransformer extends TransformerAbstract
{
    public function transform(Table $table)
    {
        return [
            'id' => (int) $table->id,
            'name' => $table->name,
            'slug' => $table->slug,
            'area_id' => $table->area_id,
            'capacity' => $table->capacity
        ];
    }
}