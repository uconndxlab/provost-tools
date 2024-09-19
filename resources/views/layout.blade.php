<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Provost Tools')</title>
    @vite('resources/scss/app.scss')
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <link rel="stylesheet" href="/banner.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-light">
<x-uconn-banner />
<header>
    @php $is_admin = Route::is('admin*'); @endphp
    <div @class(["text-bg-primary py-4", "border-bottom border-danger border-5" => $is_admin])>
        <div class="container">
            <nav class="d-flex flex-column">
                <a class="parent-title text-light text-uppercase fw-bold nav-link small" href="https://provost.uconn.edu/">
                    Office of the Provost
                </a>
                <a class="navbar-brand" class="text-light" href="/">
                    Provost Tools
                </a>
            </nav>
        </div>
    </div>
    <nav @class(["navbar navbar-expand-lg py-3",
        "bg-primary" => !$is_admin,
        "bg-primary-subtle" => $is_admin
    ]) @if(!$is_admin) data-bs-theme="dark" @endif>
        <div class="container">
            <div class="collapse navbar-collapse" id="provostToolsMainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('home') ]) href="{{ route('home') }}">{{ $is_admin ? 'Return to Website' : 'Home' }}</a>
                    </li>
                    @if ( !$is_admin )
                        <li class="nav-item dropdown">
                            <a href="#" @class(["nav-link dropdown-toggle", "active" => Route::is('faculty*')]) role="button" data-bs-toggle="dropdown" aria-expanded="false">Faculty Tools</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('faculty_salary_tables.index') }}" class="dropdown-item">Salary Tables</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => Route::is('admin.home') ]) href="{{ route('admin.home') }}">Admin</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" @class(["nav-link dropdown-toggle", "active" => Route::is('admin.faculty*')]) role="button" data-bs-toggle="dropdown" aria-expanded="false">Faculty Tools</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.faculty_salary_tables.index') }}" class="dropdown-item">Salary Tables</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => Route::is('admin.users.index') ]) href="{{ route('admin.users.index') }}">Users</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="navbar-nav">
                @if ( Auth::check() )
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->netid }}</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if ( Auth::user()->can_admin )
                                <li><a href="{{ route('admin.home') }}" class="dropdown-item">Admin</a></li>
                            @endif
                            <li><a href="{{ route('saml.logout') }}" class="dropdown-item">Log Out</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('saml.login') }}" class="nav-link">UConn Log In</a>
                @endif
            </div>
        </div>
    </nav>
</header>
<main>
    @if ( session('message') )
        <div class="container pt-4">
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        </div>
    @endif

    @yield('content')
</main>
@vite('resources/js/app.js')
</body>
</html>