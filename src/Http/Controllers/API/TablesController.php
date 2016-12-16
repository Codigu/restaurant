<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Table;
use CopyaRestaurant\Transformers\TableTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\TableRequest;
use CopyaRestaurant\Eloquent\Area;

class TablesController extends ApiBaseController
{

    public function index()
    {
        try{
            $tables = Table::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($tables, new TableTransformer);
    }

    public function show($id)
    {
        try{
            $table = Table::find($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($table, new TableTransformer);
    }

    public function store(TableRequest $request)
    {
        try {
            $table = new Table;
            $table->name = $request->name;
            $table->capacity = $request->capacity;

            $area  = Area::find($request->area_id);
            $table->area()->associate($area);
            $table->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($table, new TableTransformer);
    }

    public function update(TableRequest $request, $id)
    {

        try {
            $table = Table::find($id);
            $table->name = $request->name;
            $table->capacity = $request->capacity;

            if($table->area_id != $request->area_id){
                $area  = Area::find($request->area_id);
                $table->area()->disassociate();
                $table->area()->associate($area);
            }

            $table->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($table, new TableTransformer);
    }

    public function destroy($id)
    {
        try{
            Table::destroy($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
