<?php

namespace CopyaRestaurant\Transformers;

use League\Fractal\TransformerAbstract;
use CopyaRestaurant\Eloquent\Product;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id' => (int) $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'price' => $product->price,
            'sale_price' => $product->sale_price,
            'category_id' => $product->category_id,
            'featured_image' => $product->featured_image
        ];
    }
}