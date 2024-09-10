<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{explode('/',url()->current())[sizeof(explode('/',url()->current()))-1]}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            @if(auth()->user() && auth()->user()->role ==='admin')
                <a class=" btn btn-danger" href="{{route('dashboard')}}">
                @else
                    <a class=" btn btn-primary" href="{{route('home')}}">
            @endif
                @if(auth()->user())
                    {{Str::of(auth()->user()->name)}}
                    @else
                        User
                @endif
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    @if(auth()->user() && auth()->user()->role ==='admin')
                        <a class="nav-link active" aria-current="page" href="{{route('carts.show',[auth()->user()->id])}}">Home</a>
                        @else
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('products.index')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories')}}">Categories</a>
                    </li>
                    <li class="nav-item dropdown">
                        @yield('filter-products')
                    </li>
                </ul>

                <form class="d-flex me-3" method="get" action="{{route("searchProduct")}}">
                    <input class="form-control me-2" type="search" placeholder="Search on products" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                
                @if(auth()->user())
                <form method="post" action="{{route('auth.logout')}}">
                    @csrf
                    <input type="submit" name="logout" value="Logout" class="btn btn-danger me-2">
                </form>
                @else
                        <a href="{{route('auth.outregister')}}" class="btn btn-primary me-2">Register</a>
                        <a href="{{route('auth.login')}}" class="btn btn-secondary me-2">Login</a>
                @endif
            </div>
        </div>
    </nav>
    @yield('body')
    <footer class="footer mt-auto text-center container-fluid">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2020 Copyright:
            <a class="text-body" href="{{route('home')}}">Booka, inc</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>