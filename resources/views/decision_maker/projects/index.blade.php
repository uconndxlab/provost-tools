@extends('layout')

@section('content')
<div class="container">
    <h1>Projects</h1>
    
    <!-- Filter Form -->
    <form method="GET" action="{{ route('decision_maker.projects.index') }}" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search projects..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Add Project Button -->
    <a href="{{ route('decision_maker.projects.create') }}" class="btn btn-success mb-4">Add Project</a>

    <!-- Projects List -->
    @if($projects->count())
        <ul class="list-group">
            @foreach($projects as $project)
                <li class="list-group-item">
                    <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
                </li>
            @endforeach
        </ul>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    @else
        <p>No projects found.</p>
    @endif
</div>
@endsection