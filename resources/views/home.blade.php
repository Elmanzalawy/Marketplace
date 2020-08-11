@extends('layouts.app')

@section('content')
<style>
body{
    background:linear-gradient(45deg, white, lavender) no-repeat;
    height: 100vh;
}
</style>
<div class="container">
        <h2 class="text-center my-4">Welcome, {{Auth::user()->name}}</h2>
        <a href="{{url('products/create')}}" class="btn btn-primary">Add Product</a>

        @if(count($products)>0)
            <table class="text-center table table-striped background-light font-dark my-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Type</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                        <th class="py-4" scope="row">{{$loop->iteration}}</th>
                        <td class="py-4">{{$product->name}}</td>
                        <td class="py-4">{{$product->quantity}}</td>
                        <td class="py-4">${{$product->price}}</td>
                        <td class="py-4">{{$product->type}}</td>
                        <td class="py-4">{{$product->rating}}</td>
                        <td class="py-4">
                                {!!Form::open(['action'=>['ProductsController@destroy', $product->id], 'method'=>'POST', 'class'=>'', 'stype'=>'display:inline !important;'])!!}
                                    
                                {{-- SPOOFING METHOD --}}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete Product',['class'=>'btn btn-md btn-danger'])}}
                                <a class="my-2 btn  btn-warning "  href="{{url('products/'.$product->id.'/edit')}}">Edit</a>
                            {!!Form::close()!!}
                        </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div style="display:flex; justify-content:center;">
                <p class="text-center">{{$products->links()}}</p>
            </div>                


        @endif
</div>
@endsection
