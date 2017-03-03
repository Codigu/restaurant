<?php

namespace CopyaRestaurant\Http\Controllers\API\Sessions;

use Copya\Http\Controllers\API\ApiBaseController;
use Exception;
use Illuminate\Http\Request;


class CuisinesController extends ApiBaseController
{
    /*public function __construct()
    {
        $this->middleware(['session']);
    }*/

    public function index(Request $request)
    {
        try{
            $reservation = $request->session()->get('cuisines');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $reservation]);
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            foreach($data as $key => $value){
                $request->session()->put('cuisines.'.$key, $value);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $request->session()->get('reservation')]);
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
