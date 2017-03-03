<?php

namespace CopyaRestaurant\Http\Controllers\FrontEnd;

use Config;
use Copya\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use CopyaRestaurant\Eloquent\Product;

class ProductsController extends BaseController
{
    public function index()
    {
        $products  = Product::all();
        return view('vendor.copya.front.restaurant.shop');
    }
}
