@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <h1>Questionnaire Submissions</h1>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <colgroup>
                        <col style="width: 33%;">
                        <col style="width: 33%;">
                    </colgroup>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">School/College</th>
                            <th scope="col">Submission Date/Time</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $questionnaire)
                            <tr>
                                <td>{!! $questionnaire->school_college !!}</td>
                                <td>{!! $questionnaire->created_at !!}</td>
                                <td><a href="{{ route('budgetHearingQuestionnaire.show', $questionnaire->id) }}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endsection
