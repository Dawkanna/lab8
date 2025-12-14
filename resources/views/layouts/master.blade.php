<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book System')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <style>
        body {
            background: #f4f6fb;
        }
        .navbar { background: #2c3e50 !important; }
        .card-custom {
            border-radius: 18px;
            background: #ffffff;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        footer { background: #2c3e50; }
        .table thead tr { background: #34495e; color: white; }
    </style>

</head>
<body class="d-flex flex-column min-vh-100">

    {{-- 🔥 FULLY FIXED AUTH-AWARE NAVBAR 🔥 --}}
    <nav class="navbar navbar-expand-lg navbar-dark p-3">
        <div class="container">

            {{-- LOGO NOW GOES TO DASHBOARD (FIXED) --}}
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                BookStore
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    {{-- Books Home (public list) --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                    </li>

                    {{-- Add Book (admin/editor only) --}}
                    @can('create', App\Models\Book::class)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.create') }}">Add Book</a>
                    </li>
                    @endcan

                    {{-- Logged-in users --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                Profile
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="nav-link bg-transparent border-0 text-white">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth

                    {{-- Guests only --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest

                </ul>

            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="container my-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Please fix the errors below.</strong>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center py-3 text-white mt-auto">
        <small>laboratory 8</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
