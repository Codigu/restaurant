<?php

namespace CopyaRestaurant\Http\Controllers\FrontEnd;
use Copya\Http\Controllers\Controller as BaseController;
use CopyaRestaurant\Eloquent\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Log;

class CheckoutController extends BaseController
{
    public function doCheckout()
    {
        $cart = Cart::content();
        dd($cart);
        return view('vendor.copya.front.restaurant.checkout');
    }
}
