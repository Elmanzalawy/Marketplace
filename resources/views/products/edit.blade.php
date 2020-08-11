@extends('layouts.app')
@section('content')

<div class="container">
  <div class="jumbotron background-light">
    <h1 class="text-center">Edit Product</h1>
    {{ Form::open(['action' => ['ProductsController@update',$product->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            <div class="form-group">
                {{Form::label('title','Product Name')}}
                {{Form::text('name','',['class'=>'form-control product-name','data-name'=>$product->name])}}
            </div>

            <div class="form-group">
                {{Form::label('text','Quantity Available')}}
                {{Form::number('quantity','',['class'=>'form-control product-quantity','data-quantity'=>$product->quantity])}}
            </div>

            <div class="form-group">
                {{Form::label('text','Price (USD)')}}
                {{Form::number('price','',['class'=>'form-control product-price','data-price'=>$product->price])}}
            </div>

            <div class="form-group">
                {{Form::label('text','Product Type')}}
                {{Form::select('type', ['Electronics' => 'Electronics', 'Fashion' => 'Fashion', 'Home Appliances'=>'Home Appliances','Jewelry'=>'Jewelry','Health and Beauty'=>'Health and Beauty','Sports and Fitness'=>'Sports and Fitness'], null, ['class'=>'form-control', 'placeholder' => 'Choose product type'])}}
            </div>
    
            <div class="form-group">
                {{Form::label('text','Product Description')}}
                {{Form::textarea('description','',['class'=>'form-control product-description','data-description'=>$product->description])}}
            </div>
    
            <div class="form-group">
                    {{Form::label('Add image: ','Product Image')}}
                    {{Form::file('image')}}
            </div>
            <a href="{{url('products')}}" class="btn btn-danger my-2">Cancel</a>

            {{-- SPOOFING METHOD --}}
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Add Product',['class'=>'btn btn-primary my-2'])}}
        {{ Form::close() }}
  </div>
</div>

<script>
    var name = $('.product-name').attr('data-name');
    var quantity = $('.product-quantity').attr('data-quantity');
    var price = $('.product-price').attr('data-price');
    var type = $('.product-type').attr('data-type');
    var description = $('.product-description').attr('data-description');
    
    $('.product-name').val(name);
    $('.product-quantity').val(quantity);
    $('.product-type').val(type);
    $('.product-price').val(price);
    $('.product-description').text(description);
</script>      
@endsection