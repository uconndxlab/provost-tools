@extends('layout')
@section('title', 'Projects - Decision Maker')
@section('content')
    @include('decision_maker.parts.nav')

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Projects</h2>
            <a href="{{ route('decision_maker.projects.create') }}" class="btn btn-success">+ Add Project</a>
        </div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('decision_maker.projects.index') }}" method="GET" class="mb-3 d-flex">

                {{-- filter by complexity --}}
                <select name="complexity" class="form-select me-2">
                    <option value="">All Complexities</option>
                    <option value="Low" {{ request('complexity') == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ request('complexity') == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ request('complexity') == 'High' ? 'selected' : '' }}>High</option>
                </select>

                <select name="status" class="form-select me-2">
                    <option value="">All Statuses</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                <select name="school_college" class="form-select me-2">
                    <option value="">All Schools/Colleges</option>
                    @foreach ($schoolcolleges as $schoolCollege)
                        <option value="{{ $schoolCollege->id }}"
                            {{ request('school_college') == $schoolCollege->id ? 'selected' : '' }}>
                            {{ $schoolCollege->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        {{-- ability to sort by scores, budget, etc --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4 class="fw-bold">Projects</h4>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">

                    <li><a class="dropdown-item"
                            href="{{ route('decision_maker.projects.index', array_merge(request()->query(), ['order_by' => 'budget', 'direction' => 'desc'])) }}">Budget
                            - Highest</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('decision_maker.projects.index', array_merge(request()->query(), ['order_by' => 'budget', 'direction' => 'asc'])) }}">Budget
                            - Lowest</a></li>
                    {{-- start date--soonest --}}
                    <li><a class="dropdown-item"
                            href="{{ route('decision_maker.projects.index', array_merge(request()->query(), ['order_by' => 'start_date', 'direction' => 'asc'])) }}">Start
                            Date - Soonest</a></li>
                    {{-- start date--latest --}}
                    <li><a class="dropdown-item"
                            href="{{ route('decision_maker.projects.index', array_merge(request()->query(), ['order_by' => 'start_date', 'direction' => 'desc'])) }}">Start
                            Date - Latest</a></li>


                    {{-- for each tag, order_by tag with tag_ prefix --}}
                    @foreach ($tags as $tag)
                        <li><a class="dropdown-item"
                                href="{{ route('decision_maker.projects.index', array_merge(request()->query(), ['order_by' => 'tag_' . $tag->id, 'direction' => 'desc'])) }}">{{ $tag->name }}
                                - Highest</a></li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="row mt-4">
            @foreach ($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">

                        <div class="card-header">
                            <h5 class="fw-bold">{{ $project->name }}</h5>
                            <p class="mb-0">{{ optional($project->schoolCollege)->name }}</p>
                        </div>

                        <div class="card-body">

                            <p>
                                <span
                                    class="badge bg-{{ $project->status == 'Completed' ? 'success' : ($project->status == 'In Progress' ? 'primary' : 'warning') }}">
                                    {{ $project->status }}
                                </span>
                                <span class="badge bg-info">${{ number_format($project->budget, 2) }}</span>
                            </p>
                            <p class="mb-1">
                                <span>Start: {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</span> |
                                <span>End: {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</span>
                            </p>
                            <div class="d-flex justify-content-around mt-3">
                                @foreach ($tags as $tag)
                                    @php
                                        $weightedScore = 0;
                                        $maxScore = 0;
                                        foreach ($project->institutionalPriorities as $priority) {
                                            if ($priority->tags->contains('id', $tag->id)) {
                                                $weightedScore += $priority->pivot->score * $priority->weight;
                                                $maxScore += $priority->weight * 5;
                                            }
                                        }
                                        $progress = $maxScore > 0 ? ($weightedScore / $maxScore) * 100 : 0;
                                    @endphp
                                    <div class="text-center">
                                        <div class="progress-circle" data-progress="{{ $progress }}"></div>
                                        <small>{{ $tag->name }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('decision_maker.projects.show', $project) }}"
                                class="btn btn-primary">View</a>
                            <a href="{{ route('decision_maker.projects.edit', $project) }}"
                                class="btn btn-secondary">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".progress-circle").forEach(circle => {
                let progress = circle.getAttribute("data-progress");
                let strokeColor = progress >= 75 ? '#28a745' : progress >= 50 ? '#ffc107' : '#dc3545';
                circle.innerHTML = `<svg width="50" height="50" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" stroke="#e9ecef" stroke-width="10" fill="none"></circle>
                <circle class="progress-bar" cx="50" cy="50" r="45" stroke="${strokeColor}" 
                    stroke-width="10" fill="none" stroke-dasharray="0, 283" stroke-linecap="round" transform="rotate(-90 50 50)"></circle>
                <text x="50" y="55" font-size="20" text-anchor="middle" fill="#000">${Math.round(progress)}%</text>
            </svg>`;

                let progressBar = circle.querySelector('.progress-bar');
                let currentProgress = 0;
                let interval = setInterval(() => {
                    currentProgress += 1;
                    progressBar.setAttribute('stroke-dasharray', `${currentProgress * 2.83}, 283`);
                    if (currentProgress >= progress) {
                        clearInterval(interval);
                    }
                }, 10);
            });
        });
    </script>
@endsection
