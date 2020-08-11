@extends('layouts.app')
@section('content')

<div class="container">
  <div class="jumbotron background-light">
    <h1 class="text-center">Add Product</h1>
    {{ Form::open(['action' => 'ProductsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            <div class="form-group">
                {{Form::label('title','Product Name')}}
                {{Form::text('name','',['class'=>'form-control','placeholder'=>'Product Name'])}}
            </div>

            <div class="form-group">
                {{Form::label('text','Quantity Available')}}
                {{Form::number('quantity','',['class'=>'form-control','placeholder'=>'Add Quantity'])}}
            </div>

            <div class="form-group">
                {{Form::label('text','Price (USD)')}}
                {{Form::number('price','',['class'=>'form-control','placeholder'=>'Individual price'])}}
            </div>

            <div class="form-group">
                {{Form::label('text','Product Type')}}
                {{Form::select('type', ['Electronics' => 'Electronics', 'Fashion' => 'Fashion', 'Home Appliances'=>'Home Appliances','Jewelry'=>'Jewelry','Health and Beauty'=>'Health and Beauty','Sports and Fitness'=>'Sports and Fitness'], null, ['class'=>'form-control', 'placeholder' => 'Choose product type'])}}
            </div>
    
            <div class="form-group">
                {{Form::label('text','Product Description')}}
                {{Form::textarea('description','',['class'=>'form-control','placeholder'=>'Add description..'])}}
            </div>
    
            <div class="form-group">
                    {{Form::label('Add image: ','Product Image')}}
                    {{Form::file('image')}}
            </div>
            <a href="{{url('products')}}" class="btn btn-danger my-2">Cancel</a>

            {{Form::submit('Add Product',['class'=>'btn btn-primary my-2'])}}
        {{ Form::close() }}
  </div>
</div>

      
@endsection