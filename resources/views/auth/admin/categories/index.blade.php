@extends('auth.layout.dashboard')
@section('body')
@if ($categories->isEmpty())
    <h1 style="margin-left:38%">No categories found</h1>
    @if(auth()->user() && auth()->user()->role ==='admin')
    <a href="{{route('categories.create')}}" class="col-md-3 mb-3 mx-auto btn btn-success d-block">Add a category</a>
    @endif
    @else
        @if(auth()->user() && auth()->user()->role ==='admin')
        <a href="{{route('categories.create')}}" class="col-md-3 mb-3 mx-auto btn btn-success d-block">Add a category</a>
        @endif
        <div class="container shadow-lg ">
            <table class="table table-striped mt-2">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    @if(auth()->user() && auth()->user()->role ==='admin')
                    <th style="text-align:center">Actions</th>
                    @endif
                </tr>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    @if(auth()->user() && auth()->user()->role ==='admin')
                    <td style="text-align:center;">
                        <a href="{{route('categories.edit',[$category->id])}}" class="btn btn-info" style="width:75px">Edit</a>
                        <form method="post" action="{{route('categories.destroy',[$category->id])}}" class="d-inline">
                            @csrf
                            @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
            </table>
        </div>
    @endif    
@endsection