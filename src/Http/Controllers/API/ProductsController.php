<?php

namespace CopyaRestaurant\Http\Controllers\API;

use Copya\Http\Controllers\API\ApiBaseController;
use CopyaRestaurant\Transformers\ProductTransformer;
use Exception;
use CopyaRestaurant\Http\Requests\ProductRequest;
use CopyaRestaurant\Eloquent\Product;
use CopyaCategory\Eloquent\Category;

class ProductsController extends ApiBaseController
{
    public function index()
    {
        try{
            $products = Product::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->collection($products, new ProductTransformer);
    }

    public function show($id)
    {
        //no functionality as of the moment
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->has('description') ? $request->description : '';
            $product->price = $request->price;
            $product->sale_price = $request->has('sale_price') ? $request->sale_price : 0;
            $product->featured_image = $request->has('featured_image') ? $request->featured_image : '';

            $category  = Category::find($request->category_id);
            $product->category()->associate($category);
            $product->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($product, new ProductTransformer);
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->description = $request->has('description') ? $request->description : '';
            $product->price = $request->price;
            $product->sale_price = $request->has('sale_price') ? $request->sale_price : 0;
            $product->featured_image = $request->has('featured_image') ? $request->featured_image : '';

            if($product->category_id != $request->category_id){
                $category  = Category::find($request->category_id);
                $product->category()->disassociate();
                $product->category()->associate($category);
            }

            $product->save();

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->item($product, new ProductTransformer);
    }

    public function destroy($id)
    {
        try{
            Product::destroy($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['deleted' => true]);
    }
}
