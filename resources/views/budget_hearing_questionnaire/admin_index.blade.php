@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <h1>Questionnaire Submissions</h1>
            <table>

                {{--         'deficit_mitigation',
        'faculty_hiring',
        'student_enrollment',
        'student_retention',
        'foundation_engagement',
        'school_college' --}}

                <thead>
                    <tr>
                        <th>School/College</th>
                        <th>Deficit Mitigation</th>
                        <th>Faculty Hiring</th>
                        <th>Student Enrollment</th>
                        <th>Student Retention</th>
                        <th>Foundation Engagement</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $questionnaire)
                        <tr>
                            <td>{!! $questionnaire->school_college !!}</td>
                            <td>{!! $questionnaire->deficit_mitigation !!}</td>
                            <td>{!! $questionnaire->faculty_hiring !!}</td>
                            <td>{!! $questionnaire->student_enrollment !!}</td>
                            <td>{!! $questionnaire->student_retention !!}</td>
                            <td>{!! $questionnaire->foundation_engagement !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endsection
