@extends('layout')
@section('title', 'Budget Hearing Questionnaire Submission for ' . $submission->school->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Subnav) -->
            <div class="col-12 col-md-3 d-print-none py-5">
                <div class="card position-sticky" style="top: 100px;">
                    <div class="card-header">
                        <h5>Responses</h5>
                        <h6>{{ $submission->school->name }}</h6>
                    </div>
                    <div class="card-body">
                        <nav class="nav flex-column">
                            @if ($submission->deficit_mitigation)
                                <a class="nav-link" href="#deficit_mitigation">Deficit Mitigation</a>
                            @endif
                            @if ($submission->faculty_hiring)
                                <a class="nav-link" href="#faculty_hiring">Faculty Hiring</a>
                            @endif
                            @if ($submission->student_enrollment)
                                <a class="nav-link" href="#student_enrollment">Student Enrollment</a>
                            @endif
                            @if ($submission->student_retention)
                                <a class="nav-link" href="#student_retention">Student Retention, Graduation & Outcomes</a>
                            @endif
                            @if ($submission->foundation_engagement)
                                <a class="nav-link" href="#foundation_engagement">Philanthropy</a>
                            @endif
                            @if ($submission->library_student_enrollment)
                                <a class="nav-link" href="#library_student_enrollment">Library Student Enrollment</a>
                            @endif
                            @if ($submission->library_research_activity)
                                <a class="nav-link" href="#library_research_activity">Library Research Activity</a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->

            <div class="col-12 col-md-9">
                <div class="py-5">
                    <div class="container">
                        <div class="mb-5">


                            <div class="row">
                                <div class="col-12 mb-4 card">

                                    <div class="card-body">
                                        <h2 class="card-title">Budget Hearing Questionnaire Submission</h2>
                                        <p class="card-text fs-4">{{ $submission->school->name }}</p>
                                        <p class="card-text">Last Modified {{ $submission->updated_at->format('m/d/Y') }} by
                                            {{ $submission->history->last()->user->name }}</p>

                                        {{-- if adming, edit link --}}
                                        @if (Auth::check() && Auth::user()->can_admin)
                                            <a href="{{ route('budgetHearingQuestionnaire.create', 'school=' . $submission->school->id) }}"
                                                class="btn btn-primary d-print-none">Edit</a>
                                        @endif
                                        <!-- print with js -->
                                        <a href="javascript:window.print()" class="btn btn-primary d-print-none">Download
                                            PDF</a>
                                    </div>

                                </div>

                                @if ($submission->deficit_mitigation)
                                    <div class="col-12 card mt-3" id="deficit_mitigation">
                                        <div class="card-body">
                                            <h2 class="card-title">Deficit Mitigation</h2>
                                            <p class="card-text">{!! $submission->deficit_mitigation !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->faculty_hiring)
                                    <div class="col-12 card mt-3" id="faculty_hiring">
                                        <div class="card-body">
                                            <h2 class="card-title">Faculty Hiring</h2>
                                            <p class="card-text">{!! $submission->faculty_hiring !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->student_enrollment)
                                    <div class="col-12 card mt-3" id="student_enrollment">
                                        <div class="card-body">
                                            <h2 class="card-title">Student Enrollment</h2>
                                            <p class="card-text">{!! $submission->student_enrollment !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->student_retention)
                                    <div class="col-12 card mt-3" id="student_retention">
                                        <div class="card-body">
                                            <h2 class="card-title">Student Retention, Graduation & Outcomes</h2>
                                            <p class="card-text">{!! $submission->student_retention !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->foundation_engagement)
                                    <div class="col-12 card mt-3" id="foundation_engagement">
                                        <div class="card-body">
                                            <h2 class="card-title">Philanthropy</h2>
                                            <p class="card-text">{!! $submission->foundation_engagement !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->library_student_enrollment)
                                    <div class="col-12 card mt-3" id="library_student_enrollment">
                                        <div class="card-body">
                                            <h2 class="card-title">Library Student Enrollment</h2>
                                            <p class="card-text">{!! $submission->library_student_enrollment !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->library_research_activity)
                                    <div class="col-12 card mt-3" id="library_research_activity">
                                        <div class="card-body">
                                            <h2 class="card-title">Library Research Activity</h2>
                                            <p class="card-text">{!! $submission->library_research_activity !!}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
