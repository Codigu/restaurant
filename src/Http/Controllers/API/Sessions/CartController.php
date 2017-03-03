<?php

namespace CopyaRestaurant\Http\Controllers\API\Sessions;

use Copya\Http\Controllers\API\ApiBaseController;
use Exception;
use Illuminate\Http\Request;
use Session;
use Log;
use Illuminate\Support\Facades\Auth;

class CartController extends ApiBaseController
{

    public function index(Request $request)
    {
        try{
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $cart]);
    }


    public function store(Request $request)
    {
        try {
            Log::info(print_r(Auth::user(), true));
            $data = $request->all();
            $cart[] = $data;

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => Auth::user()]);
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
