<?php

namespace CopyaRestaurant\Http\Controllers\API\Sessions;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Exception;
use Illuminate\Http\Request;
use Log;

class CartController extends ApiBaseController
{

    public function index(Request $request)
    {
        $cart = Cart::content();
        try{
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $cart]);
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $cartItem = Cart::add(
                $data['id'],
                $data['name'],
                1,
                $data['price']
            )->associate(Product::class);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $cartItem]);
    }

    public function update(Request $request, $id)
    {
        try {
            $cartItem = Cart::update($id, $request->get('qty'));

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $cartItem]);
    }

    public function destroy(Request $request, $id)
    {
        try{
            Cart::remove($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
