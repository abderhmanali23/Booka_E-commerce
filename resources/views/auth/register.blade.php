@extends('auth.layout.dashboard')
@section('body')
<div class="card col-md-5 mt-5 mx-auto shadow-lg rounded">
    <div class="card-header">Register</div>
    <div class="card-body mx-auto col-md-7 rounded-3">
        <form class="row g-2" method="post" action="{{route('auth.store')}}">
            @csrf
            
            <div class="input-group">
                <!-- <label for="username" class=" input-group-text">U</label> -->
                <input type="username" name="username" class="form-control" id="username" placeholder="Enter a username" style="background-color:#edeae5;">
            </div>  
            @error('username')
            <span class="text-danger d-block">{{$message}}</span>
            @enderror
        
            <div class="input-group">
                <label for="email" class="input-group-text">@</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" style="background-color:#edeae5;">
            </div>
            @error('email')
            <span class="text-danger d-block">{{$message}}</span>
            @enderror
            
            <div class="input-group">
                <!-- <label for="pwd" class="input-group-text">P</label> -->
                <input type="password" name="password" class="form-control shadow-inner" id="pwd" placeholder="Enter password" style="background-color:#edeae5;">
            </div>
            @error('password')
            <span class="text-danger d-block">{{$message}}</span>
            @enderror
            
            <div class="input-group">
                <!-- <label for="pwd" class="input-group-text">P</label> -->
                <input type="password" name="confirm_pwd" class="form-control" placeholder="Confirm password" style="background-color:#edeae5;">
            </div>
            @error('confirm_pwd')
                <span class="text-danger d-block">{{$message}}</span>
            @enderror

            <button type="submit" class="col-md-5 mt-4 mx-auto btn btn-primary">Register</button>
        </form>
        <a href="login" class="m text-warning btn btn-link d-block">Already have an Email</a>
    </div>
</div>

@endsection