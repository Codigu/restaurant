@extends('layouts.app')

<ul>
    @foreach($products as $product)
        <li>
            <div><img src="{{ url($product->featured_image) }}"></div>
            <div>{{ $product->name }}</div>
            <div>{{ $product->price }}</div>
            <input class="add-to-cart" type="button" value="Add to Cart"
                   data-product_id="{{ $product->id }}"
                   data-quantity="1"
            />
        </li>
    @endforeach
</ul>

<script>
    $('')
</script>