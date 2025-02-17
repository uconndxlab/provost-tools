@extends('layout')

@section('content')
    @include('decision_maker.parts.nav')
    <div class="container pt-5">



        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="text-white">{{ $project->name }}</h2>
            </div>
            <div class="card-body">
                <p>{!! $project->description !!}</p>

                <div class="card mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h3>Project Information</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Start Date:</strong> {{ $project->start_date }}</li>
                            <li class="list-group-item"><strong>End Date:</strong> {{ $project->end_date }}</li>
                            <li class="list-group-item"><strong>Status:</strong> {{ $project->status }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h3>Weighted Scores</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="tagScoresAccordion">
                            @foreach ($tags as $index => $tag)
                                @php
                                    $weightedScore = 0;
                                    $maxScore = 0;

                                    foreach ($project->institutionalPriorities as $priority) {
                                        if ($priority->tags->contains('id', $tag->id)) {
                                            $scaledScore = ($priority->pivot->score - 1) * 0.25;
                                            $weightedScore += $scaledScore * $priority->weight;
                                            $maxScore += 1 * $priority->weight;
                                        }
                                    }

                                    $percentage = $maxScore > 0 ? ($weightedScore / $maxScore) * 100 : 0;
                                @endphp

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button @if ($index !== 0) collapsed @endif"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            <strong>{{ $tag->name }}</strong>
                                            <span
                                                class="ms-auto badge bg-primary fs-5">{{ number_format($percentage, 2) }}%</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse @if ($index === 0) show @endif"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#tagScoresAccordion">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                @foreach ($project->getPrioritiesByTag($tag->id) as $priority)
                                                    <li class="list-group-item">
                                                        <strong>{{ $priority->name }}</strong>
                                                        <span class="badge bg-dark text-dark">Weight: {{ $priority->weight }}</span>
                                                        <span class="badge bg-secondary">Score:
                                                            {{ $priority->pivot->score }}/5</span>

                                                        <div class="progress mt-2">
                                                            @php
                                                                $priorityScore = ($priority->pivot->score - 1) * 25;
                                                            @endphp
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: {{ $priorityScore }}%;"
                                                                aria-valuenow="{{ $priorityScore }}" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ number_format($priorityScore, 2) }}%
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">This contributes
                                                            {{ number_format($priorityScore, 2) }}% to the total based on a
                                                            weight of {{ $priority->weight }}.</small>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

    <style>
        .progress {
            background-color: #f3f3f3;
            border-radius: 13px;
            padding: 3px;
            margin-bottom: 10px;
        }

        .progress-bar {
            background-color: #4caf50;
            height: 20px;
            border-radius: 10px;
            text-align: center;
            color: white;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0;
        }
    </style>
@endsection
