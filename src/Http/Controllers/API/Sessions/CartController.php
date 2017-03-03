<?php

namespace CopyaRestaurant\Http\Controllers\API\Sessions;

use Copya\Http\Controllers\API\ApiBaseController;
use Exception;
use Illuminate\Http\Request;
use Session;
use Log;

class CartController extends ApiBaseController
{

    public function index(Request $request)
    {
        try{
            $cart = Session::get('cart');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $cart]);
    }


    public function store(Request $request)
    {
        try {
            Log::info("Before".print_r(Session::get('cart'), true));
            $data = $request->all();
            $cart =  Session::get('cart');

            $cart[] = $data;

            Session::put('cart', $cart);
            Log::info(print_r(Session::get('cart'), true));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $request->session()->get('cart')]);
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
