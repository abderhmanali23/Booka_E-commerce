@extends('auth.layout.dashboard')
@section('body')
    <div class="container-lg shadow-lg rounded-3 p-4 my-4" style="width:1000px;height:570px;">
        <div class="card mx-auto" style="width: 18rem">
            <div class="card-header">
                <span>Product info</span>
            </div>
            <img src="{{asset("/storage/products/$product->image")}}" class="card-img-top rounded-4 my-2" style="height: 15rem">
            <div class="card-body pe-0">
                <h5 class="card-title">Name: {{$product->name}}</h5>
                <b class="card-text d-block">Price: {{$product->price}} £</b>
                <span class="card-text d-block">{{$product->description}}</span>
                <p class="card-text d-block mb-3"><small class="text-body-secondary">Last updated {{$product->updated_at}}</small></p>
            </div>
            <div class="card-footer">
                <form method="post"  action="{{route('carts.store',[auth()->user()->id, $product->id])}}" class="d-inline-block" style="width:100%">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="submit" class="btn btn-primary" value="Add to cart" style="width:100%">
                </form>
            </div>
        </div>
    </div>
@endsection