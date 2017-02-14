<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Exception;
use Auth;
use CopyaCategory\Transformers\CategoryTransformer;
use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Category;
use CopyaCategory\Http\Requests\CategoryRequest;



class CategoriesController extends ApiBaseController
{
    public function index()
    {
        $categories = Category::whereHas('cuisines', function($query){
            $query->where('pre_orderable', '1');
        })->get();

        return $this->collection($categories, new CategoryTransformer);
    }

    public function show($id)
    {
        $navigation = Navigation::find($id);

        return $this->item($navigation, new NavigationTransformer);
    }


}
