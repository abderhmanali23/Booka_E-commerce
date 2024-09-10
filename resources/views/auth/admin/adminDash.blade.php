@extends('auth.layout.dashboard')
@section('body')
    @if ($users->isEmpty())
        <h1 style="margin-left:38%">No users found</h1>
        <a href="{{route('auth.register')}}" class="col-md-3 mb-3 mx-auto btn btn-success d-block">Add a user</a>
    @else
         <a href="{{route('auth.register')}}" class="col-md-3 mb-3 mx-auto btn btn-success d-block">Add a user</a>
        <div class="container shadow-lg ">
            <table class="table table-striped mt-2">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    @if(auth()->user() && auth()->user()->role ==='admin')
                    <th style="text-align:center">Actions</th>
                    @endif
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td class="text-capitalize">{{$user->role}}</td>
                        <td style="text-align:center;">
                            <form method="post" action="{{route('users.destroy',[$user->id])}}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@endsection