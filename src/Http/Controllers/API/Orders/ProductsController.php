<?php

namespace CopyaRestaurant\Http\Controllers\API\Orders;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Cuisine;
use CopyaRestaurant\Transformers\CuisineTransformer;
use CopyaRestaurant\Transformers\ProductTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\ReservationCuisineRequest;
use CopyaRestaurant\Eloquent\Order;

class ProductsController extends ApiBaseController
{

    public function index($order_id)
    {
        try{
            $order = Order::find($order_id);
            $products = $order->products;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($products, new ProductTransformer);
    }

    public function store(ReservationCuisineRequest $request, $reservation_id)
    {
        try {
            $reservation = Reservation::find($reservation_id);
            $cuisine = Cuisine::find($request->get('cuisine_id'));

            $reservation->cuisines()->attach([$cuisine->id => ['price' => $cuisine->price, 'quantity' => $request->get('quantity')]]);
            $cuisines = $reservation->cuisines;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($cuisines, new CuisineTransformer);
    }

    public function update(ReservationCuisineRequest $request, $reservation_id, $cuisine_id)
    {
        try {
            $reservation = Reservation::find($reservation_id);
            $cuisine = Cuisine::find($cuisine_id);

            $reservation->cuisines()->updateExistingPivot($cuisine->id, ['quantity' => $request->get('quantity')]);
            $cuisines = $reservation->cuisines;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($cuisines, new CuisineTransformer);




    }

    public function destroy($reservation_id, $cuisine_id)
    {
        try{
            $reservation = Reservation::find($reservation_id);
            $cuisine = Cuisine::find($cuisine_id);

            $reservation->cuisines()->detach($cuisine->id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);



    }

}
