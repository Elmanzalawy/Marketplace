@extends('layouts.app')
@section('content')
<style>
    .product-image {
        height: 100%;
    }

</style>
<div class="section">
    <div class="container">
        <h1 class="text-center my-4">Products</h1>
        <a href="{{url('products/create')}}" class="btn btn-outline-primary my-2">Add Product</a>

        {{-- ELECTRONICS ROW --}}
        <div class="product-row my-4">
            <h2 class="font-dark">Electronics</h2>
            @if(count($electronics) >0 )
            <div class="card-deck products electronic-products text-center my-4">
                @foreach ($electronics as $product)
                <div class="card background-light product-card">
                    <a href="{{url('products/'.$product->id)}}">

                        <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <h5 class="secondary-color card-text product-price">
                                ${{$product->price}}
                            </h5>

                        </div>
                    </a>

                </div>
                @endforeach
            </div>
            @else
            <p class="lead text-center">No products found.</p>
            @endif
        </div>

        {{-- FASHION ROW --}}
        <div class="product-row my-4">
            <h2 class="font-dark">Fashion</h2>
            @if(count($fashion) >0 )
            <div class="card-deck products fashion-products text-center my-4">
                @foreach ($fashion as $product)
                <div class="card background-light product-card">
                    <a href="{{url('products/'.$product->id)}}">

                        <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <h5 class="secondary-color card-text product-price">
                                ${{$product->price}}
                            </h5>
                    </a>

                </div>
            </div>

            @endforeach
        </div>
        @else
        <p class="lead text-center">No products found.</p>
        @endif
    </div>

    {{-- HOME APPLIANCES ROW --}}
    <div class="product-row my-4">
        <h2 class="font-dark">Home Appliances</h2>
        @if(count($homeAppliances) >0 )
        <div class="card-deck products home-products text-center my-4">
            @foreach ($homeAppliances as $product)
            <div class="card background-light product-card">
                <a href="{{url('products/'.$product->id)}}">

                    <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h5 class="secondary-color card-text product-price">
                            ${{$product->price}}
                        </h5>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p class="lead text-center">No products found.</p>
        @endif
    </div>

    {{-- Jewelry ROW --}}
    <div class="product-row my-4">
        <h2 class="font-dark">Jewelry</h2>
        @if(count($jewelry) >0 )
        <div class="card-deck products jewelry-products text-center my-4">
            @foreach ($jewelry as $product)
            <div class="card background-light product-card">
                <a href="{{url('products/'.$product->id)}}">

                    <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h5 class="secondary-color card-text product-price">
                            ${{$product->price}}
                        </h5>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p class="lead text-center">No products found.</p>
        @endif
    </div>

    {{-- Health and Beauty ROW --}}
    <div class="product-row my-4">
        <h2 class="font-dark">Health and Beauty</h2>
        @if(count($health) >0 )
        <div class="card-deck products health-products text-center my-4">
            @foreach ($health as $product)
            <div class="card background-light product-card">
                <a href="{{url('products/'.$product->id)}}">

                    <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h5 class="secondary-color card-text product-price">
                            ${{$product->price}}
                        </h5>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p class="lead text-center">No products found.</p>
        @endif
    </div>

    {{-- Sports nad Fitness ROW --}}
    <div class="product-row my-4">
        <h2 class="font-dark">Sports and Fitness</h2>
        @if(count($sports) >0 )
        <div class="card-deck products sports-products text-center my-4">
            @foreach ($sports as $product)
            <div class="card background-light product-card">
                <a href="{{url('products/'.$product->id)}}">

                    <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <h5 class="secondary-color card-text product-price">
                            ${{$product->price}}
                        </h5>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <p class="lead text-center">No products found.</p>
        @endif
    </div>

</div>
</div>

@endsection
