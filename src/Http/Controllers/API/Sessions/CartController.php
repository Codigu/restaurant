<?php

namespace CopyaRestaurant\Http\Controllers\API\Sessions;

use Copya\Http\Controllers\API\ApiBaseController;
use Exception;
use Illuminate\Http\Request;
use Session;
use Log;
use Illuminate\Support\Facades\Auth;
use CartProvider;
use Syscover\ShoppingCart\Item;
use Syscover\ShoppingCart\TaxRule;

class CartController extends ApiBaseController
{

    public function index(Request $request)
    {
        $cart = CartProvider::instance()->getCartItems();
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
            CartProvider::instance()->add([
                new Item(
                    $data['id'],
                    $data['name'],
                    1,
                    $data['price']
                ),
            ]);
            $cart = CartProvider::instance()->getCartItems();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $cart]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            foreach($data as $key => $value){
                $request->session()->put('reservation'.$key, $value);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $request->session()->get('reservation')]);
    }

    public function destroy(Request $request, $id)
    {
        try{
            $request->session()->flush();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
