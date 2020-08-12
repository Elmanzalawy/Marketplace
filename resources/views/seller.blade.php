@extends('layouts.app')

@section('content')
<style>
body{

}
</style>
<div class="container">
        <h2 class="text-center my-4">{{$seller->name}}</h2>

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
                        <td class="py-4"><a href="{{url('products/'.$product->id)}}">{{$product->name}} </a></td>
                        <td class="py-4">{{$product->quantity}}</td>
                        <td class="py-4">${{$product->price}}</td>
                        <td class="py-4">{{$product->type}}</td>
                        <td class="py-4">{{$product->rating}}</td>
                        <td class="py-4">
                            @if($product->quantity > 0)
                                <button class="btn btn-success" data-toggle="modal" data-target="#buyModal" data-quantity='{{$product->quantity}}' data-product-id='{{$product->id}}' data-product-name='{{$product->name}}' data-product-price="{{$product->price}}">Buy</button>
                                <button class="btn btn-info" data-toggle="modal" data-target="#cartModal" data-quantity='{{$product->quantity}}' data-product-id='{{$product->id}}' data-product-name='{{$product->name}}'  data-product-price="{{$product->price}}">Add to cart</button>
                            @else
                            <p class="text-center text-danger">Product unavailable.</p>
                            @endif
                        </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div style="display:flex; justify-content:center;">
                <p class="text-center">{{$products->links()}}</p>
            </div>                

            @else
            <p class="lead text-center">No products available.</p>

        @endif
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

  {{-- MODAL SCRIPT --}}
<script>
    $(document).ready(function(){
    $('.show-quantity').hide();

    // UPDATE BUY MODAL
    $('#buyModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var productName = button.data('product-name') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var productID = button.data('product-id');
    var qty = button.data('quantity');
    var price = button.data('product-price');
    var modal = $(this);
    modal.find('.modal-title').text('Buy ' + productName);
    modal.find('.qty').attr('max',qty);
    modal.find('.qty').attr('meta-price', price)
    //get the action path of the buy form
    var formAction = modal.find('form').attr('action');
    //change the action path of the form to match the current product_id
    var newAction = formAction.substr(0, formAction.indexOf('/products')) + '/products/' + productID+'/buy';
    
    //update the form action path 
    modal.find('form').attr('action', newAction);
    });


    // UPDATE CART MODAL
    $('#cartModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var productName = button.data('product-name') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var productID = button.data('product-id');
    var qty = button.data('quantity');
    var price = button.data('product-price');
    var modal = $(this);
    modal.find('.modal-title').text('Add ' + productName+' to cart');
    modal.find('.qty').attr('max',qty);
    modal.find('.qty').attr('meta-price', price)
    //get the action path of the buy form
    var formAction = modal.find('form').attr('action');
    //change the action path of the form to match the current product_id
    var newAction = formAction.substr(0, formAction.indexOf('/cart')) + '/cart/' + productID;
    
    //update the form action path 
    modal.find('form').attr('action', newAction);
    });
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
