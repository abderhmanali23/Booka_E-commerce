@extends('auth.layout.dashboard')
@section('body')
<div class="card col-md-5 mt-5 mx-auto shadow-lg rounded">
    <div class="card-header">Login</div>
    <div class="card-body mx-auto col-md-7 rounded-3">
        <form class="row g-2" method="post" action="{{route('auth.authenticate')}}">
            @csrf
        <div class="input-group">
            <label for="email" class="input-group-text">@</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" style="background-color:#edeae5;">
        </div>
        
        @error('email')
        <span class="text-danger d-block">{{$message}}</span>
        @enderror
        
        <div class="input-group">
            <!-- <label for="pwd" class="form-label">Password:</label> -->
            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter your password" style="background-color:#edeae5;">
        </div>
        
        @error('password')
        <span class="text-danger d-block">{{$message}}</span>
        @enderror
        
        @error('error')
        <span class="alert alert-danger d-block">{{$message}}</span>
        @enderror
        
            <button type="submit" class="col-md-5 mt-4 mx-auto btn btn-primary">Login</button>
        </form>
    <a href="{{route('auth.register')}}" class="btn btn-link text-warning d-block ">Don't have an Email</a>
        
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
@endsection