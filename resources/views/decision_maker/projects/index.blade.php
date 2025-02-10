@extends('layout')

@section('content')

@include('decision_maker.parts.nav')

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Projects</h2>
            <a href="{{ route('decision_maker.projects.create') }}" class="btn btn-success">+ Add Project</a>
        </div>

        <div class="card shadow-sm p-4">
            <div class="mb-3 d-flex">
                <input type="text" class="form-control me-2" placeholder="Search projects...">
                <button class="btn btn-primary">Filter</button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Project Name</th>
                            <th>Starting Budget</th>
                            <th>Current Spend</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>

                            {{-- for each one of the tags --}}
                            @foreach ($tags as $tag)
                                <th>{{ $tag->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>
                                    <a href="{{ route('decision_maker.projects.show', $project) }}"
                                        class="fw-semibold text-decoration-none">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td>${{ number_format($project->budget, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $project->current_spend <= $project->budget * 0.5 ? 'success' : ($project->current_spend <= $project->budget * 0.75 ? 'warning' : 'danger') }}">
                                        ${{ number_format($project->current_spend, 2) }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $project->status == 'Completed' ? 'success' : ($project->status == 'In Progress' ? 'primary' : 'warning') }}">
                                        {{ $project->status }}
                                    </span>
                                </td>


                                @foreach ($tags as $tag)
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="text-center">
                                                <span class="badge bg-info">Avg: {{$project->getScoresByTag($tag->id)['average_score']}}</span>
                                            </div>
                                            <div class="text-center mt-1">
                                                <span class="badge bg-secondary">Total: {{$project->getScoresByTag($tag->id)['total_score']}} / {{$project->getScoresByTag($tag->id)['possible_max_score']}}</span>
                                            </div>
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
