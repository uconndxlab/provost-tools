@extends('layout')
@section('title', 'Create Project')
@section('content')
    <div class="container">
        <h2 class="mb-4 fw-bold">Create New Project</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="projectTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                            type="button" role="tab">Project Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="priority-tab" data-bs-toggle="tab" data-bs-target="#priority"
                            type="button" role="tab">Priority Evaluation</button>
                    </li>
                </ul>

                <form action="{{ route('decision_maker.projects.store') }}" method="POST">
                    @csrf

                    <div class="tab-content" id="projectTabsContent">
                        <!-- Project Information Tab -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name">Project Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="planning">Planning</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        <label for="status">Status</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="description" name="description" style="height: 100px;" required></textarea>
                                        <label for="description">Project Description</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            required>
                                        <label for="start_date">Start Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="end_date" name="end_date">
                                        <label for="end_date">End Date</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="noEndDate">
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
                                                                        value="{{ $i }}">
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
                            @endforeach

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('noEndDate').addEventListener('change', function() {
            const endDateInput = document.getElementById('end_date');
            if (this.checked) {
                endDateInput.value = '';
                endDateInput.disabled = true;
            } else {
                endDateInput.disabled = false;
            }
        });
    </script>
@endsection
