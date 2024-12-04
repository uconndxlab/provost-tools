@extends('layout')

@section('content')
    <div class="py-5">
        <div class="container">
            <h1>Provost Tools Admin</h1>
            <p>Manage the application data.</p>

            <!-- budget questionnaire permissions on a per school/college basis -->

            <h2 class="mt-5">Budget Hearing Questionnaire Permissions</h2>

            <p>Set permissions for each school/college by adding or removing a user to that school/college.</p>

            <div class="mb-4">
                <h3>Add/Remove Permissions</h3>
                <form action="{{ route('admin.update_budget_questionnaire_permissions') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="school_id" class="form-label">School/College</label>
                        <select class="form-select" id="school_id" name="school_id">
                            @foreach ($allSchools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User (NetID)</label>
                        <input type="text" class="form-control" id="user_id" name="user_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Permission</button>
                </form>
            </div>


            <div class="mb-4">
                <h3>Current Permissions</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>School/College</th>
                            <th>Users</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allSchools as $school)
                            <tr>
                                <td>{{ $school->name }}</td>
                                <td>
                                    @if ($school->usersWithPermission('can_submit_budget_hearing_questionnaire')->count() == 0)
                                        <span class="badge text-bg-warning">No users</span>
                                    @else
                                        @foreach ($school->usersWithPermission('can_submit_budget_hearing_questionnaire')->get() as $user)
                                            <form action="{{ route('admin.update_budget_questionnaire_permissions') }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="school_id" value="{{ $school->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->netid }}">
                                                <input type="hidden" name="remove" value="1">
                                                <button type="submit" class="btn btn-link p-0 m-0">
                                                    <span class="badge text-bg-secondary dangerHover">{{ $user->name }} ({{ $user->netid }})</span>
                                                </button>
                                            </form>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
@endsection
