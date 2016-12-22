<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Order;
use CopyaRestaurant\Eloquent\Status;
use CopyaRestaurant\Transformers\OrderTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\OrderRequest;
use CopyaRestaurant\Eloquent\Area;


class OrdersController extends ApiBaseController
{

    public function index()
    {
        try{
            $reservations = Order::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($reservations, new OrderTransformer);
    }

    public function show($id)
    {
        try{
            $reservation = Order::find($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($reservation, new ReservationTransformer);
    }

    public function store(OrderRequest $request)
    {
        try {
            $order = new Order;
            $order->customer_name = $request->customer_name;
            $order->email = $request->has('email') ? $request->email : '';
            $order->phone = $request->has('phone') ? $request->phone : '';
            $order->amount = $request->amount;
            $order->discount =  $request->has('discount') ? $request->discount : 0;
            $order->note = $request->has('note') ? $request->note : '';

            //set status to pending
            $status = Status::findBySlug('pending');

            $order->status()->associate($status);
            $order->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($order, new OrderTransformer);
    }

    public function update(OrderRequest $request, $id)
    {

        try {
            $order = new Order;
            $order->customer_name = $request->customer_name;
            $order->email = $request->has('email') ? $request->email : '';
            $order->phone = $request->has('phone') ? $request->phone : '';
            $order->amount = $request->amount;
            $order->discount =  $request->has('discount') ? $request->discount : 0;
            $order->note = $request->has('note') ? $request->note : '';


            if($request->has('status_id') && $order->status_id != $request->status_id){
                $status  = Status::find($request->status_id);
                $order->status()->disassociate();
                $order->status()->associate($status);
            }

            $order->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($order, new OrderTransformer);
    }

    public function destroy($id)
    {
        try{
            Order::destroy($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
