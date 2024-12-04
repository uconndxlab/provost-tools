@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="mb-5">

                <div class="row">
                    <div class="col-12">
                        <h1>Budget Hearing Questionnaire</h1>
                        <p class="fs-4">{{ $submission->school->name }}</p>
                        <p>Last Modified {{ $submission->updated_at->format('m/d/Y') }} by {{ $submission->history->last()->user->name }}</p>
                    </div>
                </div>

                <hr> 
                <div class="row">
                    <div class="col-12 mt-3">
                        <h2>Deficit Mitigation</h2>
                        <p>{!! $submission->deficit_mitigation !!}</p>
                    </div>

                    <div class="col-12 mt-3">
                        <h2>Faculty Hiring</h2>
                        <p>{!! $submission->faculty_hiring !!}</p>
                    </div>

                    <div class="col-12 mt-3">
                        <h2>Student Enrollment</h2>
                        <p>{!! $submission->student_enrollment !!}</p>
                    </div>

                    <div class="col-12 mt-3">
                        <h2>Student Retention, Graduation & Outcomes</h2>
                        <p>{!! $submission->student_retention !!}</p>
                    </div>

                    <div class="col-12 mt-3">
                        <h2>Foundation Engagement</h2>
                        <p>{!! $submission->foundation_engagement !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
