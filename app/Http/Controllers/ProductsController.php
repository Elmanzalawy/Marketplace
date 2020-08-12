<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\User;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    public function index()
    {
        $data = array(
            'electronics'=> Product::where('type','Electronics')->orderBy('created_at','desc')->get(),
            'fashion' => Product::where('type','Fashion')->orderBy('created_at','desc')->get(),
            'homeAppliances' => Product::where('type','Home Appliances')->orderBy('created_at','desc')->get(),
            'jewelry' => Product::where('type','Jewelry')->orderBy('created_at','desc')->get(),
            'health' => Product::where('type','Health and Beauty')->orderBy('created_at','desc')->get(),
            'sports' => Product::where('type','Sports and Fitness')->orderBy('created_at','desc')->get(),
        );
        return view('products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'=> 'image|nullable|max:10000'
        ]);
        //handle file upload
        $filenameToStore = "";
        if($request->hasFile('image')){
            //Get file name with extentsion
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename."_".time().".".$extension; // making the filename unique to prevent image overwriting

            //Upload image
            $path = $request->file('image')->storeAs('public/product_images',$filenameToStore);

            //create product
            $product = new Product;
            $product->seller_id = auth()->user()->id;
            $product->seller_name = auth()->user()->name;
            $product->image = $filenameToStore;
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->type = $request->input('type');
            $product->quantity = $request->input('quantity');
            $product->price = $request->input('price');

            $product->save();
            return redirect('/dashboard')->with('success','Successfully added product');
        }else{
            return redirect('login')->with('error','Login to create products.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $data = array(
            'product' => $product,
            'similarProducts'=>Product::where('type',$product->type)->where('id','!=',$product->id)->take(10)->orderBy('created_at','desc')->get(),

        );
        return view('products/show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if(auth()->user()->id==$product->seller_id){
        return view('products/edit')->with('product', $product);
        }
        else{
         return back()->with('error','Error: Unauthorized user.');
         }
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
        $product =Product::find($id);
        if (Auth::check()) {
            //handle file upload
            $filenameToStore = $product->image;
            if($request->hasFile('image')){
                //Get file name with extentsion
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $extension = $request->file('image')->getClientOriginalExtension();
                //Filename to store
                $filenameToStore = $filename."_".time().".".$extension; // making the filename unique to prevent image overwriting

                //Upload image
                $path = $request->file('image')->storeAs('public/product_images',$filenameToStore);

            }
            else{
                // $fileNameToStore = "placeholder-image.png";
            }
            //if product image is changed, delete the previous image from storage
            if($product->image != $filenameToStore){
                unlink('storage/product_images/'.$product->image);
            }

            //edit product
            $product->seller_id = auth()->user()->id;
            $product->seller_name = auth()->user()->name;
            $product->image = $filenameToStore;
            $product->name = $request->input('name') ?? $product->name;
            $product->price = $request->input('price') ?? $product->price;
            $product->type = $request->input('type') ?? $product->type;
            $product->quantity = $request->input('quantity') ?? $product->quantity;
            $product->description = $request->input('description') ?? $product->description;

            $product->save();
            return redirect('/dashboard')->with('success','Product edited.');
        }else{
            return redirect('/dashboard')->with('error','Error editing product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(auth()->user()->privilege=='admin' || auth()->user()->id==$product->seller_id){
            unlink('storage/product_images/'.$product->image);
            // if(isset($comments)){
            //     $comments->delete();
            //     $product->delete();
            //     $votes->delete();
            // }
            $product->delete();
            return redirect('/dashboard')->with('success','Successfully deleted product.');
        }else{
            return back()->with('error','Unauthorized user.');
        }        
    }

    public function buy(Request $request, $id){
        $product = Product::find($id);
        $quantity = $request->input('quantity');
        if($product->quantity >= $quantity && $product->seller_id != auth()->user()->id){
            $product->quantity = $product->quantity - $quantity;
            $product->save();
            return back()->with('success','Successfully purchased '.$quantity.' units of '.$product->name);
        }else{
            if($product->seller_id == auth()->user()->id){
                return back()->with('error','Error: Cannot purchase your own products');
            }else{
                return back()->with('error','Error: please enter a valid quantity.');
            }
        }
        
    }

    public function seller(Request $request, $id){
        $data = array(
            'seller' => User::find($id),
            'products' => Product::where('seller_id', $id)->orderBy('created_at','desc')->paginate(25),
        );
        return view('seller')->with($data);
    }
}
