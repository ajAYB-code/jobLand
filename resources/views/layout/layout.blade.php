<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">

    {{-- Custom page CSS --}}
    @yield('pageStyle')

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>
<body>
        <!-- Navbar -->

        <nav class="navbar navbar-expand-sm py-4">
            <div class="container">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <h4>jobLand</h4>
                    </a>
                <ul class="navbar-nav gap-4 ms-5 me-auto">
                   <li class="nav-item">
                    <a href="{{ route('home') }}" class="{{request()->is('/') ? 'active' : ''}} nav-link">Find jobs</a>
                   </li>
                   <li class="nav-item">
                    <a href="/jobs/create" class="{{request()->is('jobs/create') ? 'active' : ''}} nav-link">Create job</a>
                   </li>
                   <li class="nav-item">
                    <a href="{{ route('about') }}" class="{{request()->is('about') ? 'active' : ''}} nav-link">About us</a>
                   </li>
                </ul>
                

                {{-- Search --}}

                <form action="/" class="form me-3">
                    <div class="input-group">
                        <input class="form-control" type="text" name="search_for"  value="{{request()->search_for}}" id="" placeholder="Company, skills, tag">
                        <button class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>


                @auth

                <div class="d-flex align-items-center">
                    <span>Welcome Mr <span class="user-name">{{Auth::user()->fullName}}</span></span>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('user_account') }}" class="dropdown-item">Account</a>
                            <a href="{{ route('user_created_jobs') }}" class="dropdown-item">My jobs</a>
                            <a href="{{ route('user_favorited_jobs') }}" class="dropdown-item">Favorites</a>
                            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>

                @else

                <div class="action-btns">
                    <a href="{{ route('signup') }}" class="btn btn-outline-secondary">Signup</a>
                    <x-primary-button href="{{ route('login') }}">
                        <x-slot name='content'>
                            Login
                        </x-slot>
                    </x-primary-button>
                </div>
                @endauth

            </div>
        </nav>

    {{-- Content --}}

    @yield('content')

    {{-- Footer --}}

    <footer class="mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="" class="logo text-decoration-none text-dark" style="font-weight: bold;font-size: 1.3rem;">jobLand</a>
                </div>
                <div class="col-4">
                    <p class="mb-0">Made with love by <i>Ajarai Ayoub</i></p>
                </div>
                <div class="col-4">
                    <div class="links d-flex gap-5">
                        <a href="{{ route('home') }}" class="{{request()->is('/') ? 'active' : ''}} link text-decoration-none ">Jobs</a>
                        <a href="/jobs/create" class="{{request()->is('jobs/create') ? 'active' : ''}} link text-decoration-none">Upload job</a>
                        <a href="{{ route('about') }}" class="{{request()->is('about') ? 'active' : ''}} link text-decoration-none">About us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>