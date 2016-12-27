<?php

namespace CopyaRestaurant\Http\Controllers\API\Sessions;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Reservation;
use CopyaRestaurant\Eloquent\Status;
use CopyaRestaurant\Transformers\ReservationTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\ReservationSessionRequest;
use CopyaRestaurant\Eloquent\Area;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReservationsController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware(['session']);
    }

    public function index(Request $request)
    {
        try{
            $reservation = $request->session()->get('reservation');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $reservation]);
    }

    public function show(Request $request, $id)
    {
        try{
            $reservation = $request->session()->get('reservation');
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
                $request->session()->put('reservation.'.$key, $value);
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
