<?php

namespace CopyaRestaurant\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Table extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'tables';
    protected $fillable = ['name', 'area_id', 'capacity'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function area()
    {
        return $this->belongsTo('CopyaRestaurant\Eloquent\Area');
    }
}
