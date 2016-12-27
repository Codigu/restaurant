<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Reservation;
use CopyaRestaurant\Eloquent\Status;
use CopyaRestaurant\Transformers\ReservationTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\ReservationRequest;
use CopyaRestaurant\Eloquent\Area;
use Carbon\Carbon;


class ReservationsController extends ApiBaseController
{

    public function index()
    {
        try{
            $reservations = Reservation::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($reservations, new ReservationTransformer);
    }

    public function show($id)
    {
        try{
            $reservation = Reservation::find($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($reservation, new ReservationTransformer);
    }

    public function store(ReservationRequest $request)
    {
        try {
            $reservation = new Reservation;
            $reservation->customer_name = $request->customer_name;
            $reservation->email = $request->has('email') ? $request->email : '';
            $reservation->guest_count = $request->guest_count;
            $reservation->phone = $request->has('phone') ? $request->phone : '';
            $reservation->is_agent = $request->has('is_agent') ? (bool) $request->is_agent : false;
            $reservation->amount = $request->amount;
            $reservation->discount =  $request->has('discount') ? $request->discount : 0;
            $reservation->deposit = $request->has('deposit') ? $request->deposit : 0;
            $reservation->note = $request->has('note') ? $request->note : '';
            $reservation->reserved_at = new Carbon($request->reserved_at);

            $area  = Area::find($request->area_id);
            //set status to pending
            $status = Status::findBySlug('pending');
            $reservation->area()->associate($area);
            $reservation->status()->associate($status);
            $reservation->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($reservation, new ReservationTransformer);
    }

    public function update(ReservationRequest $request, $id)
    {

        try {
            $reservation = Reservation::find($id);

            $reservation->customer_name = $request->customer_name;
            $reservation->email = $request->has('email') ? $request->email : '';
            $reservation->guest_count = $request->guest_count;
            $reservation->phone = $request->has('phone') ? $request->phone : '';
            $reservation->is_agent = $request->has('is_agent') ? (bool) $request->is_agent : false;
            $reservation->amount = $request->amount;
            $reservation->discount =  $request->has('discount') ? $request->discount : 0;
            $reservation->deposit = $request->has('deposit') ? $request->deposit : 0;
            $reservation->note = $request->has('note') ? $request->note : '';
            $reservation->reserved_at = new Carbon($request->reserved_at);

            if($reservation->area_id != $request->area_id){
                $area  = Area::find($request->area_id);
                $reservation->area()->disassociate();
                $reservation->area()->associate($area);
            }

            if($request->has('status_id') && $reservation->status_id != $request->status_id){
                $status  = Status::find($request->status_id);
                $reservation->status()->disassociate();
                $reservation->status()->associate($status);
            }

            $reservation->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($reservation, new ReservationTransformer);
    }

    public function destroy($id)
    {
        try{
            Reservation::destroy($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
