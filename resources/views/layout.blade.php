<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Provost Tools')</title>
    <link rel="stylesheet" href="https://use.typekit.net/nyu4feu.css">
    @vite('resources/scss/app.scss')
    {{--
    <link rel="stylesheet" href="style.css"> --}}
    <link rel="stylesheet" href="/banner.css">
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

</head>

<body class="bg-light position-relative">
    <x-uconn-banner />
    <header>
        @php $is_admin = Route::is('admin*'); @endphp
        <div @class(["text-bg-primary py-4", "border-bottom border-danger border-5"=> $is_admin])>
            <div class="container">
                <p class="header-level-two"><a href="https://provost.uconn.edu/"
                        class="link-underline-opacity-0 link-underline-opacity-100-hover link-light link-offset-2">Office
                        of the Provost</a></p>
                <h1 class="header-level-one"><a href="/"
                        class="link-underline-opacity-0 link-underline-opacity-100-hover link-light link-offset-1">Provost
                        Tools</a></h1>
            </div>
        </div>
        <nav @class(["navbar navbar-expand-lg py-3", "bg-primary"=> !$is_admin,
            "bg-primary-subtle" => $is_admin
            ]) @if(!$is_admin) data-bs-theme="dark" @endif>
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#provostToolsMainNav" aria-controls="provostToolsMainNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="provostToolsMainNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        @if ( !$is_admin )
                        <li class="nav-item dropdown">
                            <a href="#" @class(["nav-link dropdown-toggle", "active"=> Route::is('faculty*')])
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Available Tools</a>
                            <ul class="dropdown-menu">
                                {{-- <li><a href="{{ route('faculty_salary_tables.index') }}" class="dropdown-item">Salary
                                        Tables</a></li> --}}
                                <li><a href="{{route('budgetHearingQuestionnaire.create')}}" class="dropdown-item">Budget
                                        Hearing Questionnaire</a></li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle disabled" role="button"
                                aria-expanded="false">University Tools</a>
                        </li> --}}
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Return to Site</a>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active'=> Route::is('admin.home') ]) href="{{ route('admin.home')
                                }}">Admin</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" @class(["nav-link dropdown-toggle", "active"=> Route::is('admin.faculty*')])
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Tools for Faculty</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.faculty_salary_tables.index') }}"
                                        class="dropdown-item">Salary Tables</a></li>
                                <li><a href="{{ route('admin.budgetHearingQuestionnaire.index') }}"
                                        class="dropdown-item">Budget Hearing Questionnaire</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active'=> Route::is('admin.users.index') ]) href="{{
                                route('admin.users.index') }}">Users</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="navbar-nav">
                    @if ( Auth::check() )
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if ( Auth::user()->can_admin )
                            <li><a href="{{ route('admin.home') }}" class="dropdown-item">Admin</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}" class="dropdown-item">Log Out</a></li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="nav-link">UConn Log In</a>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <main>
        @if ( session('success') )
        <div class="container pt-4">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif
        @if ( session('message') )
        <div class="container pt-4">
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        </div>
        @endif

        @if ( $errors->any() )

        <div class="container pt-4">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p class="mb-1">{{ $error }}</p>
                @endforeach
            </div>
        </div>
        @endif

        @if ( session('error') )
        <div class="container pt-4">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
        @endif

        @yield('content')
    </main>
    <footer class="text-bg-dark d-block w-100 py-4">
        <div class="container">
            <div class="d-flex w-100 flex-column flex-md-row justify-content-center align-items-center">
                <a class="p-4 link-light link-underline-opacity-0 link-underline-opacity-100-hover"
                    href="https://uconn.edu/">© {{ date('Y') }} University of Connecticut</a>
                <a class="p-4 link-light link-underline-opacity-0 link-underline-opacity-100-hover"
                    href="http://uconn.edu/disclaimers-privacy-copyright/">Disclaimers, Privacy &amp; Copyright</a>
                <a class="p-4 link-light link-underline-opacity-0 link-underline-opacity-100-hover"
                    href="https://accessibility.uconn.edu/">Accessibility</a>
            </div>
        </div>
    </footer>
    @vite('resources/js/app.js')
</body>

</html>