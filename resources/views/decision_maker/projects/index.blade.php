@extends('layout')
@section('title', 'Projects - Decision Maker')
@section('content')
    @include('decision_maker.parts.nav')

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Projects</h2>
            <a href="{{ route('decision_maker.projects.create') }}" class="btn btn-success text-white">+ Add Project</a>
        </div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('decision_maker.projects.index') }}" method="GET" class="mb-3 d-flex">

                {{-- filter by complexity --}}
                <select hx-target="#projects" hx-swap="outerHTML" hx-select="#projects" hx-indicator="body"
                    hx-trigger="change" hx-get="{{ route('decision_maker.projects.index') }}" name="complexity"
                    class="form-select me-2">
                    <option value="">All Complexities</option>
                    <option value="low" {{ request('complexity') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('complexity') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('complexity') == 'high' ? 'selected' : '' }}>High</option>
                </select>

                <select hx-target="#projects" hx-swap="outerHTML" hx-select="#projects" hx-indicator="body"
                    hx-trigger="change" hx-get="{{ route('decision_maker.projects.index') }}" name="status"
                    class="form-select me-2">
                    <option value="">All Statuses</option>
                    <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        {{-- ability to sort by scores, budget, etc --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
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

        <div id="projects" class="row mt-4">
            @foreach ($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">

                            {{-- dates, small and tidy --}}
                            <div class="d-flex justify-content-between mb-2" style="font-size: 1rem; font-weight: 800;">
                                <small>{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</small>
                                <small><span class="badge bg-info">${{ number_format($project->budget, 2) }}</span></small>
                                @if ($project->end_date)
                                    <small>{{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</small>
                                @else
                                    <small>(Ongoing)</small>
                                @endif
                            </div>
                            <h6 class="fw-bold">
                                {{ $project->name }}


                            </h6>
                            <span
                                class="badge bg-{{ $project->status == 'Completed' ? 'success' : ($project->status == 'In Progress' ? 'primary' : 'warning') }}">
                                {{ $project->status }}
                            </span>

                            <span
                                class="badge bg-{{ $project->complexity == 'low' ? 'success' : ($project->complexity == 'medium' ? 'warning' : 'danger') }}">
                                {{ $project->complexity }} complexity
                            </span>

                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-around mt-3">
                                @foreach ($tags as $tag)
                                @php
                                    $weightedScore = 0;
                                    $totalWeight = 0;
                            
                                    foreach ($project->institutionalPriorities as $priority) {
                                        if ($priority->tags->contains('id', $tag->id)) {
                                            $totalWeight += $priority->weight; // Sum up weights
                            
                                            $weightedScore += $project->getWeightedScoreByPriority($priority->id);
                                        }
                                    }
                            
                                    // Normalize weighted score to percentage
                                    $progress = ($totalWeight > 0) ? ($weightedScore / ($totalWeight * 100)) * 100 : 0;
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
        function updateProgressCircles() {
            document.querySelectorAll(".progress-circle").forEach(circle => {
                let progress = circle.getAttribute("data-progress");

                circle.innerHTML = `
            <svg width="120" height="120" viewBox="0 0 100 100">
                <!-- Background Circle -->
                <circle cx="50" cy="50" r="45" stroke="#e9ecef" stroke-width="10" fill="none"></circle>

                <!-- Gradient Definition (Red to Green) -->
                <defs>
                    <linearGradient id="progressGradient" gradientUnits="userSpaceOnUse" x1="50" y1="5" x2="50" y2="95">
                        <stop offset="0%" style="stop-color:#00FF00; stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#00AA00; stop-opacity:1" />
                    </linearGradient>
                </defs>

                <!-- Progress Circle -->
                <circle class="progress-bar" cx="50" cy="50" r="45" stroke="url(#progressGradient)" 
                    stroke-width="10" fill="none" stroke-dasharray="0, 283" stroke-linecap="round" 
                    transform="rotate(-90 50 50)">
                </circle>

                <!-- Percentage Text -->
                <text x="50" y="55" font-size="22" font-weight="bold" text-anchor="middle" fill="#333">${Math.round(progress)}%</text>
            </svg>`;

                let progressBar = circle.querySelector('.progress-bar');
                let currentProgress = 0;
                let interval = setInterval(() => {
                    currentProgress += 1;
                    progressBar.setAttribute('stroke-dasharray', `${currentProgress * 2.83}, 283`);
                    if (currentProgress >= progress) {
                        clearInterval(interval);
                    }
                }, 8);
            });
        }

        document.addEventListener("DOMContentLoaded", updateProgressCircles);
        document.addEventListener("htmx:afterSwap", updateProgressCircles);
    </script>

@endsection
