<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Eloquent\Cuisine;
use CopyaRestaurant\Transformers\CuisineTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\CuisineRequest;
use CopyaRestaurant\Eloquent\Area;
use CopyaCategory\Eloquent\Category;

class CuisinesController extends ApiBaseController
{

    public function index()
    {
        try{
            $cuisines = Cuisine::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($cuisines, new CuisineTransformer);
    }

    public function show($id)
    {
        //no functionality as of the moment
    }

    public function store(CuisineRequest $request)
    {
        try {
            $cuisine = new Cuisine;
            $cuisine->name = $request->name;
            $cuisine->description = $request->has('description') ? $request->description : '';
            $cuisine->price = $request->price;
            $cuisine->sale_price = $request->has('sale_price') ? $request->sale_price : 0;
            $cuisine->featured_image = $request->has('featured_image') ? $request->featured_image : '';

            $category  = Category::find($request->category_id);
            $cuisine->category()->associate($category);
            $cuisine->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($cuisine, new CuisineTransformer);
    }

    public function update(CuisineRequest $request, $id)
    {

        try {
            $cuisine = Cuisine::find($id);
            $cuisine->name = $request->name;
            $cuisine->description = $request->has('description') ? $request->description : '';
            $cuisine->price = $request->price;
            $cuisine->sale_price = $request->has('sale_price') ? $request->sale_price : 0;
            $cuisine->featured_image = $request->has('featured_image') ? $request->featured_image : '';

            if($cuisine->category_id != $request->category_id){
                $category  = Category::find($request->category_id);
                $cuisine->category()->disassociate();
                $cuisine->category()->associate($category);
            }

            $cuisine->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($cuisine, new CuisineTransformer);
    }

    public function destroy($id)
    {
        try{
            Cuisine::destroy($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
