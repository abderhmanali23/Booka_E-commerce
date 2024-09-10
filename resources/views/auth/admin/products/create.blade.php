@extends('auth.layout.dashboard')
@section('body')
    <div class="card col-md-5 mx-auto mt-5 shadow-lg rounded">  
        <div class="card-header">Create product</div>
        <div class="card-body mx-auto col-md-10 rounded-3">
            <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <!-- <label for="name" class="form-label"><b>Product name:</b></label> -->
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter product name">
                    @error('name')
                        <span class="text-danger d-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <textarea class="form-control" name="description" placeholder="Enter product description minimum 20 letters.."></textarea>
                    @error('description')
                        <span class="text-danger d-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-2">
                    <select class="form-select" name="category_id">
                        <option disabled selected>Category..</option>
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
                <div class="mb-2">
                    <div class="input-group">
                        <span class="input-group-text">£</span>
                        <input type="number" class="form-control" name="price" placeholder="Enter product price">
                        <span class="input-group-text">.00</span>
                    </div>
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
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection