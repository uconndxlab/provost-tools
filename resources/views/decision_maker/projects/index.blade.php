@extends('layout')

@section('content')

@include('decision_maker.parts.nav')

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Projects</h2>
            <a href="{{ route('decision_maker.projects.create') }}" class="btn btn-success">+ Add Project</a>
        </div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('decision_maker.projects.index') }}" method="GET" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search projects..." value="{{ request('search') }}">
                <select name="status" class="form-select me-2">
                    <option value="">All Statuses</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                <select name="unit" class="form-select me-2">
                    <option value="">All Units</option>
                    @foreach ($schoolcolleges as $schoolcollege)
                        <option value="{{ $schoolcollege->id }}" {{ request('unit') == $schoolcollege->id ? 'selected' : '' }}>{{ $schoolcollege->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Unit</th>
                            <th>Project Name</th>
                            <th>Status</th>
                            
                            <th>Starting Budget</th>
                            <th>Current Spend</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            

                            {{-- for each one of the tags --}}
                            @foreach ($tags as $tag)
                                <th class="bg-accent">
                                    {{ $tag->name }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>
                                    
                                    {{ $project->user->name }}
                                </td>
                                <td>
                                    <a href="{{ route('decision_maker.projects.edit', $project) }}"
                                        class="fw-semibold text-decoration-none">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $project->status == 'Completed' ? 'success' : ($project->status == 'In Progress' ? 'primary' : 'warning') }}">
                                        {{ $project->status }}
                                    </span>
                                </td>
                                <td>${{ number_format($project->budget, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $project->current_spend <= $project->budget * 0.5 ? 'success' : ($project->current_spend <= $project->budget * 0.75 ? 'warning' : 'danger') }}">
                                        ${{ number_format($project->current_spend, 2) }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</td>



                                @foreach ($tags as $tag)
                                    <td class="bg-accent">
                                        <div class="d-flex flex-column align-items-center">
                                            @if ($project->getScoresByTag($tag->id)['total_score'] == 0)
                                                <span class="badge bg-light text-dark">N/A</span>
                                            @else
                                            <div class="text-center mt-1">
                                                @php
                                                    $scoreRatio = $project->getScoresByTag($tag->id)['total_score'] / $project->getScoresByTag($tag->id)['possible_max_score'];
                                                    $badgeClass = 'bg-secondary';
                                                    if ($scoreRatio >= 0.75) {
                                                        $badgeClass = 'bg-success';
                                                    } elseif ($scoreRatio >= 0.5) {
                                                        $badgeClass = 'bg-warning';
                                                    } else {
                                                        $badgeClass = 'bg-danger';
                                                    }
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">Total: {{$project->getScoresByTag($tag->id)['total_score']}} / {{$project->getScoresByTag($tag->id)['possible_max_score']}}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                @endforeach


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
