<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'cartItems'=> Cart::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->get(),
        );
        return view('products.cart')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product->seller_id != auth()->user()->id){
            $cartItem = new Cart;
            $cartItem->product_id = $product->id;
            $cartItem->product_name = $product->name;
            $cartItem->user_id = auth()->user()->id;
            $cartItem->quantity = $request->input('quantity');
            $cartItem->price = $cartItem->quantity * $product->price;
            $cartItem->seller_name = $product->seller_name;
            $cartItem->seller_id = $product->seller_id;
            $cartItem->save();
            return redirect('cart')->with('sucess','Item added to cart.');  
        }else{
            return back()->with('error','Error: cannot purchase your own products');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // delete cart item
    public function destroy($id)
    {
        $cartItem = Cart::find($id);
        $cartItem->delete();
        return redirect('cart')->with('success','Cart item '.$cartItem->product_name.' has been deleted');
    }

    //buy all cart items
    public function buyAll(){
        $cartItems = Cart::where('user_id', auth()->user()->id)->get(); //fetch user cart items
        foreach($cartItems as $cartItem){
            $product = Product::find($cartItem->product_id);
            $quantity = $cartItem->quantity;
            if($product->quantity >= $cartItem->quantity){
                $product->quantity = $product->quantity - $cartItem->quantity;
                $product->save();
                $cartItem->delete();
            }else{
                return redirect('cart')->with('error','Error: '.$cartItem->product_name.' only has '.$product->quantity.' units available');
            }
        }
        return redirect('cart')->with('success','Sucessfully purchased cart items');
    }
}
