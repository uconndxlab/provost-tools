@extends('layout')
@section('title', 'Edit Project')
@section('content')

@include('decision_maker.parts.nav')

    <div class="container">
        <h2 class="my-4">Edit Project</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="projectTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                            type="button" role="tab">Project Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="priority-tab" data-bs-toggle="tab" data-bs-target="#priority"
                            type="button" role="tab">Priority Alignment</button>
                    </li>
                </ul>

                <form action="{{ route('decision_maker.projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="tab-content" id="projectTabsContent">
                        <!-- Project Information Tab -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
                                        <label for="name">Project Name</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="planning" {{ $project->status == 'planning' ? 'selected' : '' }}>Planning</option>
                                            <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <label for="status">Status</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- budget --}}
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="budget" name="budget" value="{{ $project->budget }}" required>
                                        <label for="budget">Starting Budget</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- current spend --}}
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="current_spend" name="current_spend" value="{{ $project->current_spend }}" required>
                                        <label for="current_spend">Current Spend</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="description" name="description" style="height: 100px;" required>{{ $project->description }}</textarea>
                                        <label for="description">Project Description</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
                                        <label for="start_date">Start Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}">
                                        <label for="end_date">End Date</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="noEndDate" {{ $project->end_date ? '' : 'checked' }}>
                                        <label class="form-check-label" for="noEndDate">
                                            No end date
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Priority Evaluation Tab -->
                        <div class="tab-pane fade" id="priority" role="tabpanel">
                            {{-- accordions for each tag --}}
                            @foreach ($tags as $tag)
                                <div class="accordion mb-3" id="tag{{ $tag->id }}Accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $tag->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $tag->id }}" aria-expanded="true"
                                                aria-controls="collapse{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $tag->id }}" class="accordion-collapse collapse show"
                                            aria-labelledby="heading{{ $tag->id }}"
                                            data-bs-parent="#tag{{ $tag->id }}Accordion">
                                            <div class="accordion-body">
                                                <div class="form-group my-3">

                                                    @foreach ($tag->institutionalPriorities as $priority)
                                                        <div class="mb-3">
                                                            <label
                                                                for="priority{{ $priority->id }}"><strong>{{ $priority->name }}</strong></label>

                                                            <span>{!! $priority->description !!}</span>

                                                            <div class="btn-group" role="group"
                                                                aria-label="Priority Rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <input type="radio" class="btn-check"
                                                                        name="priority_rating[{{ $priority->id }}]"
                                                                        id="priority{{ $priority->id }}-{{ $i }}"
                                                                        value="{{ $i }}" {{ $project->getScoreByPriority($priority->id) == $i ? 'checked' : '' }}>
                                                                    <label class="btn btn-outline-primary"
                                                                        for="priority{{ $priority->id }}-{{ $i }}">{{ $i }}</label>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const endDateInput = document.getElementById('end_date');
            const noEndDateCheckbox = document.getElementById('noEndDate');
            if (noEndDateCheckbox.checked) {
                endDateInput.disabled = true;
            }
            noEndDateCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    endDateInput.value = '';
                    endDateInput.disabled = true;
                } else {
                    endDateInput.disabled = false;
                }
            });
        });
    </script>
@endsection
