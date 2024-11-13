<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inspiro')</title>
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-lg">
            <a class="navbar-brand" href="#">
                <h1>Inspiro</h1>
                <span class="tagline">A place where ideas grow</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
              
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('publicuploads.index') }}">Explore</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Register</a></li>
                    @endguest
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item"><a class="nav-link text-white" href="{{ route('categories.index') }}">Categories</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">My Uploads</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('saves') }}">Saved Uploads</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('uploads.create') }}">Upload New Post</a></li>
                    @endauth
                </ul>


                <div class="d-flex align-items-center gap-3">
                   
                    <form class="d-flex" action="{{ route('uploads.search') }}" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search" required>
                        <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
                    </form>

                    @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 Inspiro. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
