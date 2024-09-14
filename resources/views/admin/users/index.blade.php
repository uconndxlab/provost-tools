@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <h1>User Management</h1>
        <p>See who has logged into the system.</p>

        {{ $users->links() }}

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">NetID</th>
                        <th scope="col">EmplID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->netid }}</td>
                        <td>{{ $user->emplid }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->can_admin ? 'Yes' : '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection