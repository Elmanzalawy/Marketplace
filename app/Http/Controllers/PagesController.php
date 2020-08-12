<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
class PagesController extends Controller
{
    //
    public function index(){
        $data = array(
            'recentProducts'=>Product::orderBy('created_at','desc')->take(10)->get(),
        );
        return view('index')->with($data);
    }

    public function about(){
        return view('about');
    }
}
