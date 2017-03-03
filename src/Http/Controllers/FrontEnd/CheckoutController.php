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
        Log::info("CART? ".print_r(Session::all(), true ) );
        return view('vendor.copya.front.restaurant.checkout');
    }
}
