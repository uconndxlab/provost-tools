@extends('layout')
@section('title', 'Budget Hearing Questionnaire Submission for ' . $submission->school->name)

@section('content')
    <div class="container-fluid">
        @can ('can_create_budget_questionnaire', $submission->school)
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
                    <div class="card-footer">
                        <a href="javascript:window.print()" class="btn btn-primary d-print-none">Download PDF</a>
                        @can ('can_create_budget_questionnaire', $submission->school)
                        <a href="{{ route('budgetHearingQuestionnaire.create', 'school=' . $submission->school->id) }}"
                            class="btn btn-secondary d-print-none">Edit Submission</a>
                        @endcan
                    </div>
                </div>

            </div>

            @php
            $sections = [
            'deficit_mitigation' => [
            'school_types' => ['school', 'campus', 'library'],
            'title' => 'Deficit Mitigation',
            'description' => 'Please explain how your unit will meet the FY25 – FY29 budget hearing guidance shared by the Provost and CFO, focusing on FY26 – FY27, including reducing vacancies/positions, decreasing programming, or eliminating services.  Additionally, include any plans for the one-time use of operating or Foundation fund balances to bridge the gap until permanent reductions are achieved.'
            ],
            'faculty_hiring' => [
            'school_types' => ['school'],
            'title' => 'Research Goals and Targeted Faculty Hiring',
            'description' => 'Are you actively recruiting any endowed chairs/professorships or targeted hires with a robust research portfolio? If not, where might you consider doing so to build on existing or emerging strengths in your unit?'
            ],
            'student_enrollment' => [
            'school_types' => ['school','campus'],
            'title' => 'Instructional Needs and Student Enrollment',
            'description' => 'What academic programs have the demand to increase in net new enrollment based on your discussions with Student Life & Enrollment? What additional resources would be needed to support the increased enrollment and instructional needs?'
            ],
            'student_retention' => [
            'school_types' => ['school', 'campus'],
            'title' => 'Student Retention, Graduation & Post-Graduation Outcomes',
            'description' => 'We are fundamentally here to serve our students, ensuring that they receive value in their education to achieve future success. What is your unit doing to improve student retention and graduation rates, and how do you track post-graduation outcomes?'
            ],
            'foundation_engagement' => [
            'school_types' => ['school'],
            'title' => 'Philanthropy',
            'description' => 'To align with these budget plans and strategic investments in research, enrollment growth, and student success initiatives, what major gifts of $100,000 or more are currently in the pipeline?'
            ],
        
            'library_student_enrollment' => [
            'school_types' => ['library'],
            'title' => 'Student Enrollment',
            'description' => 'Are there any additional resources that would be needed to support increased enrollment in the
            student body?'
            ],
        
            'library_research_activity' => [
            'school_types' => ['library'],
            'title' => 'Research Activity',
            'description' => 'What resources do you need to ensure that the Library is able to support the University’s research
            goals?'
            ],
            ];
            @endphp

            <!-- Main Content Area -->

            <div class="col-12 col-md-9">
                <div class="py-5">
                    <div class="container questionnaire-responses">
                        <div class="mb-5">


                            <div class="row">
                                <div class="col-12 mb-4 card print-page cover-page">

                                    <div class="card-body">
                                        <h2 class="card-title">Budget Hearing Questionnaire Submission</h2>
                                        
                                        
                                        
                                        <p class="card-text fs-4">{{ $submission->school->name }}</p>
                                        <p class="card-text d-print-none">Last Modified {{ $submission->updated_at->format('m/d/Y') }} by
                                            {{ $submission->history->last()->user->name }}</p>

                                        {{-- if adming, edit link --}}
                                  
                                    </div>
                                </div>

                                @if ($submission->deficit_mitigation)
                                    <div class="col-12 card mt-3 print-page q-response" id="deficit_mitigation">
                                        <div class="card-body">
                                            <h2 class="card-title">Deficit Mitigation</h2>

                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['deficit_mitigation']['description']}}
                                            </div>
                                            {{-- answer --}}
                                            <p class="card-text">{!! $submission->deficit_mitigation !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->faculty_hiring)
                                    <div class="col-12 card mt-3 print-page q-response" id="faculty_hiring">
                                        <div class="card-body">
                                            <h2 class="card-title">Faculty Hiring</h2>
                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['faculty_hiring']['description']}}
                                            </div>
                                            {{-- answer --}}
                                            <p class="card-text">{!! $submission->faculty_hiring !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->student_enrollment)
                                    <div class="col-12 card mt-3 print-page q-response" id="student_enrollment">
                                        <div class="card-body">
                                            <h2 class="card-title">Student Enrollment</h2>

                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['student_enrollment']['description']}}
                                            </div>
                                            {{-- answer --}}
                                            <p class="card-text">{!! $submission->student_enrollment !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->student_retention)
                                    <div class="col-12 card mt-3 print-page q-response" id="student_retention">
                                        <div class="card-body">
                                            <h2 class="card-title">Student Retention, Graduation & Outcomes</h2>

                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['student_retention']['description']}}
                                            </div>
                                            {{-- answer --}}
                                            <p class="card-text">{!! $submission->student_retention !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->foundation_engagement)
                                    <div class="col-12 card mt-3 print-page q-response" id="foundation_engagement">
                                        <div class="card-body">
                                            <h2 class="card-title">Philanthropy</h2>
                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['foundation_engagement']['description']}}
                                            </div>
                                            {{-- answer --}}
                                            <p class="card-text">{!! $submission->foundation_engagement !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->library_student_enrollment)
                                    <div class="col-12 card mt-3 print-page q-response" id="library_student_enrollment">
                                        <div class="card-body">
                                            <h2 class="card-title">Library Student Enrollment</h2>

                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['library_student_enrollment']['description']}}
                                            </div>
                                            {{-- answer --}}
                                            <p class="card-text">{!! $submission->library_student_enrollment !!}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($submission->library_research_activity)
                                    <div class="col-12 card mt-3 print-page q-response" id="library_research_activity">
                                        <div class="card-body">
                                            <h2 class="card-title">Library Research Activity</h2>

                                            <div class="question-text">
                                                {{-- question text --}}
                                                {{$sections['library_research_activity']['description']}}
                                            </div>
                                            {{-- answer --}}
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
        @endcan
        @cannot ('can_create_budget_questionnaire', $submission->school)
        <div class="alert alert-warning">You do not currently have access to submit this form. 
            Please contact i3@uconn.edu if you think this is incorrect.</div>
        @endcannot
    </div>
@endsection
