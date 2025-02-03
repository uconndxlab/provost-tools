<nav class="app-nav navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Decision Maker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('decision_maker.projects.index') }}">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('decision_maker.institutional_priorities.index') }}">Institutional Priorities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>