@extends('layouts.app')

@section('content')
<style>
body{

}
</style>
<div class="container">
        <h2 class="text-center my-4">Welcome, {{Auth::user()->name}}</h2>
        <a href="{{url('dashboard')}}" class="btn btn-primary">Dashboard</a>

        @if(count($cartItems)>0)
            <table class="text-center table table-striped background-light font-dark my-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $cartItem)
                <tr>
                        <th class="py-4" scope="row">{{$loop->iteration}}</th>
                        <td class="py-4"><a href="{{url('products/'.$cartItem->product_id)}}">{{$cartItem->product_name}} </a></td>
                        <td class="py-4">{{$cartItem->quantity}}</td>
                        <td class="py-4 item-price">{{$cartItem->price}}</td>
                        <td class="py-4">{{$cartItem->seller_name}}</td>
                        <td class="py-4">
                                {!!Form::open(['action'=>['CartController@destroy', $cartItem->id], 'method'=>'POST', 'class'=>'', 'stype'=>'display:inline !important;'])!!}
                                    
                                {{-- SPOOFING METHOD --}}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete cart item',['class'=>'btn btn-md btn-danger'])}}
                            {!!Form::close()!!}
                        </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <h5 class="secondary-color my-3 pull-left">Total Price: $<span id="total-price"></span></h5>
            <a href="{{url('cart/buyAll')}}" class="btn btn-primary pull-right my-2">Buy All</a>

        @else
        <h4 class="text-center my-4">No cart items found.</h4>
        @endif
</div>
<script>
let totalPrice = 0;
// let priceCell = $('.price-cell');
// priceCell.forEach(element => {
//     // totalPrice+=parseFloat(element.val());
// });
$('.item-price').each(function(i) {
    totalPrice+= parseFloat($(this).text());
    console.log(totalPrice);
});
$('#total-price').text(totalPrice);

</script>
@endsection
