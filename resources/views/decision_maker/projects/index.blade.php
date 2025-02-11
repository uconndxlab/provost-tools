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
                <input type="text" name="search" class="form-control me-2" placeholder="Search projects..."
                    value="{{ request('search') }}">
                <select name="status" class="form-select me-2">
                    <option value="">All Statuses</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                <select name="unit" class="form-select me-2">
                    <option value="">All Units</option>
                    @foreach ($schoolcolleges as $schoolcollege)
                        <option value="{{ $schoolcollege->id }}"
                            {{ request('unit') == $schoolcollege->id ? 'selected' : '' }}>{{ $schoolcollege->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            @foreach ($tags as $tag)
                                <col style="width: 10%;">
                            @endforeach
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'unit';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'unit', 'direction' => $newDirection])) }}">
                                    Unit {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'name';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'name', 'direction' => $newDirection])) }}">
                                    Project {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'status';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'status', 'direction' => $newDirection])) }}">
                                    Status {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'budget';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'budget', 'direction' => $newDirection])) }}">
                                    Budget {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'current_spend';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'current_spend', 'direction' => $newDirection])) }}">
                                    Current Spend {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'start_date';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'start_date', 'direction' => $newDirection])) }}">
                                    Start Date {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                @php
                                    $isCurrent = request('order_by') == 'end_date';
                                    $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a
                                    href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'end_date', 'direction' => $newDirection])) }}">
                                    End Date {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            @foreach ($tags as $tag)
                                <th class="bg-accent">
                                    @php
                                        $isCurrent = request('order_by') == 'tag_' . $tag->id;
                                        $newDirection = $isCurrent && request('direction') == 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a
                                        href="{{ route('decision_maker.projects.index', array_merge(request()->all(), ['order_by' => 'tag_' . $tag->id, 'direction' => $newDirection])) }}">
                                        {{ $tag->name }} {!! $isCurrent ? ($newDirection == 'asc' ? '↑' : '↓') : '' !!}
                                    </a>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->user->name }}</td>
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
                                <td>
                                    <span class="badge bg-info">
                                        ${{ number_format($project->budget, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $project->current_spend <= $project->budget * 0.5 ? 'success' : ($project->current_spend <= $project->budget * 0.75 ? 'warning' : 'danger') }}">
                                        ${{ number_format($project->current_spend, 2) }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</td>
                                {{-- Display weighted scores per tag --}}
                                @foreach ($tags as $tag)
                                    @php
                                        $weightedScore = 0;
                                        $maxScore = 0;

                                        foreach ($project->institutionalPriorities as $priority) {
                                            if ($priority->tags->contains('id', $tag->id)) {
                                                $weightedScore += $priority->pivot->score * $priority->weight;
                                                $maxScore += $priority->weight * 5; // Assuming max score is 100 per weight unit
                                            }
                                        }
                                    @endphp

                                <td>
                                    <div class="progress" style="height: 20px;">
                                        @php
                                            $progress = $maxScore > 0 ? ($weightedScore / $maxScore) * 100 : 0;
                                            $progressColor = $progress >= 75 ? 'bg-success' : ($progress >= 50 ? 'bg-warning' : 'bg-danger');
                                        @endphp
                                        <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($progress, 2) }}%
                                        </div>
                                    </div>
                                    <a href="{{ route('decision_maker.projects.show', $project) }}" class="btn btn-link">Show</a>
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
