@extends('auth.layout.dashboard')
@section('body')
    <div class="card col-md-5 mx-auto mt-5 shadow-lg rounded">
        <div class="card-header">Create category</div>
        <div class="card-body mx-auto col-md-10 rounded-3">
            <form method="post" action="{{route('categories.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><b>Category name:</b></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name">
                </div>
                @error('name')
                    <span class="alert alert-danger d-block">{{$message}}</span>
                @enderror
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

@endsection