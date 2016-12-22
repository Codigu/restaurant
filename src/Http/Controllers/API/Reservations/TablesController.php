<?php

namespace CopyaRestaurant\Http\Controllers\API\Reservations;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Table;
use CopyaRestaurant\Transformers\TableTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\ReservationTableRequest;
use CopyaRestaurant\Eloquent\Reservation;
use Validator;

class TablesController extends ApiBaseController
{

    public function index($reservation_id)
    {
        try{
            $reservation = Reservation::find($reservation_id);
            $tables = $reservation->tables;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($tables, new TableTransformer);
    }

    public function store(ReservationTableRequest $request, $reservation_id)
    {
        try {
            $reservation = Reservation::find($reservation_id);
            $tables = array();
            foreach($request->get('tables') as $table){
                $tables[] = $table['id'];
            }

            $reservation->tables()->sync($tables);
            $tables = $reservation->tables;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($tables, new TableTransformer);
    }
}
