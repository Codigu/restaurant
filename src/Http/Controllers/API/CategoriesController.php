<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Exception;
use Auth;
use CopyaCategory\Transformers\CategoryTransformer;
use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Category;
use CopyaCategory\Http\Requests\CategoryRequest;



class ShopCategoriesController extends ApiBaseController
{
    public function index()
    {
        $categories = Category::whereHas('products', function($query){
            $query->where('pre_orderable', '0');
        })->get();

        return $this->collection($categories, new CategoryTransformer);
    }


}
