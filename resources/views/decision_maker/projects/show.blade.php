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
                    @foreach ($tags as $tag)
                        <div class="card mt-3">
                            <div class="card-header bg-info text-white">
                                <h4>{{ $tag->name }}</h4>

                                @php
                                $weightedScore = 0;
                                $maxScore = 0;

                                foreach ($project->institutionalPriorities as $priority) {
                                    if ($priority->tags->contains('id', $tag->id)) {
                                        $weightedScore += $priority->pivot->score * $priority->weight;
                                        $maxScore += $priority->weight * 5; // Assuming max score is 100 per weight unit
                                    }
                                }
                                $percentage = ($maxScore > 0) ? ($weightedScore / $maxScore) * 100 : 0;
                                @endphp

                                <div class="display-4 text-center mt-2 text-dark">
                                    {{ number_format($percentage, 2) }}%
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($project->getPrioritiesByTag($tag->id) as $priority)
                                        <li class="list-group-item">
                                            {{ $priority->name }}: 
                                            <div class="progress mt-2">
                                                @php
                                                    $weightedScore = ($priority->pivot->score / 5) * 100;
                                                @endphp
                                                <div class="progress-bar" role="progressbar" style="width: {{ $weightedScore }}%;" aria-valuenow="{{ $weightedScore }}" aria-valuemin="0" aria-valuemax="100">
                                                    {{ $weightedScore }}%
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
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