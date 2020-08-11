@extends('layouts.app')
@section('content')

<div class="container">

<div class="row my-2">
  <div class="col-md-3 col-sm-3"></div>
  <div class="col-md-6 col-sm-6">
    <div id="product" class="card backround-light text-center" style="">
      <a class="gallery-anchor" href="{{url('storage/product_images/'.$product->image)}}"><img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt=""></a>
      <div class="card-body">
        <h5 class="card-titlestrong my-4 product-name">{{$product->name}}</h5>
        <p class="card-text lead align-left">{{$product->description}}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Price: <span class="secondary-color strong">${{$product->price}}</span></li>
        <li class="list-group-item">Quantity Available: {{$product->quantity}}</li>
        <li class="list-group-item">Seller: {{$product->seller_name}}</li>
        <li class="list-group-item">Category: {{$product->type}}</li>
      </ul>
      <div class="card-body">
        <a href="#" class="btn btn-success card-link">Buy</a>
        <a href="#" class="card-link btn btn-primary">Add to cart</a>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-3">
</div>

  

  </div>
  @if(count($similarProducts) > 0)
  <h2 class="text-center mt-4">Similar Products</h2>

  <div class="row">
    <div class="col-md-12 col-sm-12">
    <div class="card-deck similar-products text-center my-4">
      @foreach ($similarProducts as $product)
          <div class="card background-light font-dark product-card">
              <a href="{{url('products/'.$product->id)}}">

              <img class="card-img-top" src="{{url('storage/product_images/'.$product->image)}}" alt="">
          <div class="card-body">
              <h5 class="card-title">{{$product->name}}</h5>
              <h5 class="secondary-color card-text product-card-price">
                  ${{$product->price}}
              </h5>

          </div>
      </a>

          </div>
      @endforeach

    </div>
  </div>
  </div>
  @endif
</div>

      
@endsection