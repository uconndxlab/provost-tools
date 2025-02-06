@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <h1 class="mb-4">2025 Animation Schowcase Submissions</h1>

            {{ $submissions->links() }}
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                   {{-- institution, submittor name, submittor email, date submitted, view etc --}}
                    <colgroup>
                        <col style="width: 33%;">
                    </colgroup>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Institution</th>
                            <th scope="col">Submittor Name</th>
                            <th scope="col">Submittor Email</th>
                            <th scope="col">Date Submitted</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $submission)
                            <tr>
                                <td>{{ $submission->institution }}</td>
                                <td>{{ $submission->submittor_name }}</td>
                                <td>{{ $submission->submittor_email }}</td>
                                <td>{{ $submission->created_at->format('m/d/Y')}}</td>
                                <td><a href="{{ route('admin.animationShowcaseSubmissions.show', $submission->id) }}">View</a></td>
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
