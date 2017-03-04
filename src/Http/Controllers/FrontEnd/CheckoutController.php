<?php

namespace CopyaRestaurant\Http\Controllers\FrontEnd;
use Copya\Http\Controllers\Controller as BaseController;
use CopyaRestaurant\Eloquent\Product;
use Session;
use Log;
use CartProvider;

class CheckoutController extends BaseController
{
    public function doCheckout()
    {
        $cart = CartProvider::instance()->getCartItems();


        $productIds = [];
        //get products from cart
        foreach($cart as $item){
            $productIds[] = $item['id'];
        }

        $products = Product::whereIn('id', $productIds)->get();

        return view('vendor.copya.front.restaurant.checkout', ['products' => $products]);
    }
}
