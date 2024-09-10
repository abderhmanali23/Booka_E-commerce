@extends('auth.layout.dashboard')
@section('body')
    <div class="container-lg col-md-5 mt-5 shadow-lg rounded">
        <div class="mx-auto col-md-10 rounded-3">
            <form method="post" action="{{route('categories.update',[$category->id])}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label"><b>New category name:</b></label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$category->name}}">
                </div>
                @error('name')
                    <span class="alert alert-danger d-block">{{$message}}</span>
                @enderror
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection