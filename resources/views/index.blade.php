@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
    }

</style>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{url('storage/product_images/carousel-1.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item ">
                <img src="{{url('storage/product_images/carousel-2.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item ">
                <img src="{{url('storage/product_images/carousel-3.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item ">
                <img src="{{url('storage/product_images/carousel-4.png')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="section background-light">
            <div class="container">
                    <h2 class="text-center">POPULAR PRODUCTS</h2>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi non eaque enim minima perspiciatis ratione autem pariatur exercitationem est quidem minus, ducimus voluptas maiores animi blanditiis et a corporis. Quis sit, esse reprehenderit nulla debitis rem voluptatibus modi et voluptas iure nihil, autem inventore laboriosam iusto sint deserunt corporis sunt?</p>
            </div>
    </div>
    <div class="section background-dark">
        <div class="container">
                <h2 class="text-center">RECENTLY ADDED</h2>
                @if(count($recentProducts) > 0)

                <div class="card-deck recent-products text-center my-4">
                    @foreach ($recentProducts as $product)
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
                <div class="your-class">
                    
                </div>
                @endif
        </div>
    </div>



@endsection
