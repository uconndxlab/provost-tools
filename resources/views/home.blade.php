@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <p class="display-6">Welcome to Provost Tools.</p>

        <p><a href="{{ route('faculty_salary_tables.index') }}">Faculty Salary Tables</a></p>
    </div>
</div>
@endsection