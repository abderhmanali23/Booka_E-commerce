@extends('auth.layout.dashboard')
@section('body')
    <div class="card mx-auto col-md-5 mt-5 shadow-lg rounded">
        <div class="card-header">Edit Product</div>
        <div class="card-body mx-auto col-md-10 rounded-3">
            <form method="post" action="{{route('products.update',[$product->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group mb-3"> 
                    <label for="name" class="input-group-text">New prouct name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$product->name}}">
                    @error('name')
                        <span class="text-danger d-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="input-group mb-3"> 
                    <label for="description" class="input-group-text">New prouct description</label>
                    <textarea name="description" class="form-control" id="description">{{$product->description}}</textarea>
                    @error('description')
                    <span class="text-danger d-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">New prouct category</span>
                    <select class="form-select" name="category_id">
                            <option selected value="{{$categories[$product->category_id]->id}}">{{$categories[$product->category_id]->name}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger d-block">{{$message}}</span>
                        @enderror
                </div>
                <div class="input-group mb-3"> 
                        <span class="input-group-text">£</span>
                        <input type="number" class="form-control" name="price" value="{{$product->price}}">
                        <span class="input-group-text">.00</span>
                    @error('price')
                    <span class="text-danger d-block">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <input type="file" name="image" class="form-control mb-4" multiple>
                    @error('image')
                        <span class="text-danger d-block">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
@endsection