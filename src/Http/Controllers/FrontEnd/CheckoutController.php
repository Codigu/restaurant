<?php

namespace CopyaRestaurant\Http\Controllers\FrontEnd;
use Copya\Http\Controllers\Controller as BaseController;
use Session;
use Log;

class CheckoutController extends BaseController
{
    public function doCheckout()
    {
        $cart = Session::get('cart');
        Log::info(print_r(Session::get('cart'), true ) );
        return view('vendor.copya.front.restaurant.checkout');
    }
}
