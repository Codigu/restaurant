<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Area extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'areas';
    protected $fillable = ['name', 'description', 'smoking'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
