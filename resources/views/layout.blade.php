<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Provost's Operational Efficiency Toolkit</title>
    <link rel="stylesheet" href="https://use.typekit.net/nyu4feu.css">
    @vite('resources/scss/app.scss')
    {{--
    <link rel="stylesheet" href="style.css"> --}}
    <link rel="stylesheet" href="/banner.css">
    {{-- material design icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

</head>

<body class="bg-light position-relative">
    <div class="d-print-none">
        <x-uconn-banner />
        <header>
            @php $is_admin = Route::is('admin*'); @endphp
            <div @class([
                'py-4 text-black',
                'border-bottom border-danger border-5' => $is_admin,
            ])>
                <div class="container d-flex align-items-center justify-content-between">
                    <div>
                        <p class="header-level-two">
                            <a href="https://provost.uconn.edu/"
                                class="link-offset-2">
                                Office of the Provost
                            </a>
                        </p>
                        <h1 class="header-level-one">
                            <a href="/"
                                class="link-offset-1">
                                Provost's Operational Efficiency Toolkit
                            </a>
                        </h1>
                    </div>
                    <!-- Navigation Menu -->
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#provostToolsMainNav" aria-controls="provostToolsMainNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="provostToolsMainNav">
                            <ul class="navbar-nav ms-auto">
                                @if (!$is_admin)
                                    <li class="nav-item dropdown">
                                        <a href="#" @class([
                                            'nav-link dropdown-toggle',
                                            'active' => Route::is('faculty*'),
                                        ]) role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Available Tools
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('budgetHearingQuestionnaire.create') }}"
                                                    class="dropdown-item">
                                                    Budget Hearing Questionnaire
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        {{-- login --}}
                                        @if (Auth::check())
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                                        @endif
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('home') }}">Return to Site</a>
                                    </li>
                                    <li class="nav-item">
                                        <a @class(['nav-link', 'active' => Route::is('admin.home')]) href="{{ route('admin.home') }}">
                                            Admin
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a href="#" @class([
                                            'nav-link dropdown-toggle',
                                            'active' => Route::is('admin.faculty*'),
                                        ]) role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Tools to Admin
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('admin.faculty_salary_tables.index') }}"
                                                    class="dropdown-item">
                                                    Salary Tables
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.budgetHearingQuestionnaire.index') }}"
                                                    class="dropdown-item">
                                                    Budget Hearing Questionnaire
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a @class(['nav-link', 'active' => Route::is('admin.users.index')]) href="{{ route('admin.users.index') }}">Users
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
    </div>


    <main class="curved-main">
        <div class="main-content">
            @if (session('success'))
                <div class="container pt-4">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('message'))
                <div class="container pt-4">
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())

                <div class="container pt-4">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="mb-1">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="container pt-4">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    <footer class="text-primary d-block w-100 py-4 d-print-none">
        <div class="container">
            <div class="d-flex w-100 flex-column flex-md-row justify-content-center align-items-center">
                <a class="p-4 link-dark link-underline-opacity-0 link-underline-opacity-100-hover"
                    href="https://uconn.edu/">© {{ date('Y') }} University of Connecticut</a>
                <a class="p-4 link-dark link-underline-opacity-0 link-underline-opacity-100-hover"
                    href="http://uconn.edu/disclaimers-privacy-copyright/">Disclaimers, Privacy &amp; Copyright</a>
                <a class="p-4 link-dark link-underline-opacity-0 link-underline-opacity-100-hover"
                    href="https://accessibility.uconn.edu/">Accessibility</a>
            </div>
        </div>
    </footer>
    @vite('resources/js/app.js')
</body>

</html>
