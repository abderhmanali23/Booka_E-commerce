@extends('auth.layout.dashboard')

@section('filter-products')
    <div class="dropdown">
        <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Filter by category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($categories as $category)
                <li><a class="dropdown-item" href="{{route('categoryProducts',[$category->id])}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
    
@endsection

@section('body')
    @if ($products->isEmpty())
        <h1 style="margin-left:38%">No products found</h1>
        @if(auth()->user() && auth()->user()->role ==='admin')
        <a href="{{route('products.create')}}" class="col-md-3 mb-3 mx-auto btn btn-success d-block">Add a product</a>
        @endif
    @else
        @if(auth()->user() && auth()->user()->role ==='admin')
        <a href="{{route('products.create')}}" class="col-md-3 mb-3 mx-auto btn btn-success d-block">Add a product</a>
        @endif
        <div class="container d-flex mx-auto row g-2 shadow-lg rounded-3">
            @foreach($products as $product)
            <div class="card  row g-3 mx-auto mb-3 rounded-4" style="width: 18rem">
                    <img src="{{asset("/storage/products/$product->image")}}" class="card-img-top rounded-4" style="height: 15rem">
                    <div class="card-body pe-0">
                        <h5 class="card-title">Name: {{$product->name}}</h5>
                        <b class="card-text d-block">Price: {{$product->price}} £</b>
                        <span class="card-text d-block">{{Str::of($product->description)->limit(3)}}</span>
                        <p class="card-text d-block mb-3"><small class="text-body-secondary">Last updated {{$product->updated_at}}</small></p>
                    </div>
                    @if(auth()->user() && auth()->user()->role ==='admin')
                        <div class="card-footer justify-content-evenly d-flex">
                            <a href="{{route('products.edit', [$product->id])}}" class="btn btn-info" style="width:75px">Edit</a>
                            <a href="{{route('products.show', [$product->id])}}" class="btn btn-warning" style="width:75px">Show</a>
                            <form method="post" action="{{route('products.destroy',[$product->id])}}" class="d-inline-block" style="width:75px">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </div>
                        @else
                        <div class="card-footer justify-content-evenly mt-5">
                            <a href="{{route('products.show', [$product->id])}}" class="btn btn-info me-5" style="width:100%">Show</a>
                        </div>
                    @endif
                </div>
                @if (!($cnt%4))
                <div>
                    <hr style="border-width:2px;width:500px;display:block;position:relative;left:30%;color:brown">
                </div>
                @endif
                @php
                    $cnt++;
                @endphp
            @endforeach         
        </div>
        {{$products->links()}}        
    @endif    
@endsection
