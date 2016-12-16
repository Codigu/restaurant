<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Status extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'statuses';
    protected $fillable = ['name',];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
