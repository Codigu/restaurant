<?php

namespace CopyaRestaurant\Http\Controllers\FrontEnd;

use Config;
use Copya\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use CopyaRestaurant\Eloquent\Product;

class ReservationsController extends BaseController
{
    public function index()
    {
        return view('vendor.copya.front.restaurant.reservation');
    }
}
