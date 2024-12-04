@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <h1 class="mb-4">Questionnaire Submissions</h1>

            {{ $submissions->links() }}
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <colgroup>
                        <col style="width: 33%;">
                    </colgroup>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">School/College</th>
                            <th scope="col">Submission Date/Time</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Last Modified By</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $questionnaire)
                            <tr>
                                <td>{{ $questionnaire->school->name }}</td>
                                <td>{{ $questionnaire->created_at->format('m/d/Y')}}</td>
                                <td>{{ $questionnaire->updated_at->format('m/d/Y')}}</td>
                                <td>{{ $questionnaire->history->last()->user->name }} ({{ $questionnaire->history->last()->user->netid }})</td>
                                <td><a href="{{ route('budgetHearingQuestionnaire.show', $questionnaire->id) }}">View</a></td>
                            </tr>
                        @endforeach

                        @if ( $submissions->isEmpty() )
                            <tr>
                                <td colspan="5">No submissions found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $submissions->links() }}
            </div>

        </div>
    @endsection
