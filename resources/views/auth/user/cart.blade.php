@extends('auth.layout.dashboard')
@section('body')
    @if (!($products) || $products->isEmpty())
        <h1 style="margin-left:38%">Your cart is empty</h1>
    @else
        <form method="post" action="{{route('carts.destroy',[auth()->user()->id])}}" class="col-md-3 mb-3 mx-auto d-block" style="width:200px">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" style="width:100%" value="Clear Cart">
        </form>
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
                    <div class="card-footer d-flex">
                        <a href="{{route('products.show', [$product->id])}}" class="btn btn-warning" style="width:75px">Show</a>
                        <form method="post" action="{{route('cartproduct.destroy',[$product->id])}}" class="col-md-3 mx-auto" style="width:60%">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" style="width:100%" value="Remove product">
                        </form>
                    </div>
                        
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