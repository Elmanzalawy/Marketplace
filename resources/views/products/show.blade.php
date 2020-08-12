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
        <li class="list-group-item">Seller: <a href="{{url('seller/'.$product->seller_id)}}">{{$product->seller_name}}</a></li>
        <li class="list-group-item">Category: {{$product->type}}</li>
      </ul>
      <div class="card-body">
        @if($product->quantity > 0 && Auth::user()->id != $product->seller_id)
        <button class="btn btn-success" data-toggle="modal" data-target="#buyModal">Buy</button>
        <button class="btn btn-info" data-toggle="modal" data-target="#cartModal">Add to cart</button>
        @elseif(Auth::user()->id == $product->seller_id)
        {!!Form::open(['action'=>['ProductsController@destroy', $product->id], 'method'=>'POST', 'class'=>'', 'stype'=>'display:inline !important;'])!!}
                                    
                                {{-- SPOOFING METHOD --}}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete Product',['class'=>'btn btn-md btn-danger'])}}
                                <a class="my-2 btn  btn-warning "  href="{{url('products/'.$product->id.'/edit')}}">Edit</a>
                            {!!Form::close()!!}
        @else
        <p class="text-danger text-center">Product currently unavailable.</p>
        @endif
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-3">
</div>

{{-- BUY MODAL --}}
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyModal">Buy {{$product->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(['action' => ['ProductsController@buy',$product->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            <div class="form-group">
              {{Form::label('quantity','Select Quantity')}}

              <input type="number" name="quantity" min="1" max="{{$product->quantity}}" class="form-control qty" meta-price='{{$product->price}}'>
              <h4 class="show-price secondary-color mt-4 text-center"></h4>
            </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {{-- SPOOFING METHOD --}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Confirm Purchase',['class'=>'btn btn-primary my-2'])}}
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

{{-- CART MODAL --}}
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModal">Add {{$product->name}} to cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(['action' => ['CartController@update',$product->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            <div class="form-group">
              {{Form::label('quantity','Select Quantity')}}

            <input type="number" name="quantity" min="1" max="{{$product->quantity}}" class="form-control qty" meta-price='{{$product->price}}'>
              <h4 id="show-price" class="secondary-color mt-4 text-center"></h4>
            </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        {{-- SPOOFING METHOD --}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Add to cart',['class'=>'btn btn-primary my-2'])}}
        {{ Form::close() }}
      </div>
    </div>
  </div>
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

{{-- MODAL SCRIPT --}}
<script>
    $(document).ready(function(){
    $('.show-quantity').hide();
    });

    // dynmaically update cost in Buy and Cart modals
    $('.qty').keyup(function(){
      let qty = $(this).val();
      let showPrice =  $(this).next();
      let price = $(this).attr('meta-price') * qty;
      showPrice.show();
      showPrice.text('$'+price);
    });

</script>
@endsection
