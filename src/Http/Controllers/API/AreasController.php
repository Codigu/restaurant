<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Copya\Http\Controllers\API\ApiBaseController;
use Exception;
use CopyaRestaurant\Eloquent\Area;
use CopyaRestaurant\Transformers\AreaTransformer;

class AreasController extends ApiBaseController
{

    public function index()
    {
        try{
            $areas = Area::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($areas, new AreaTransformer);
    }
}
