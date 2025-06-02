@extends('layout')
@section('title', 'Faculty Salary Tables')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="mb-5">
                <div class="d-flex align-items-start">
                    <h1>Faculty Salary Tables</h1>
                    @if (Auth::check() && Auth::user()->can_admin)
                        <a href="{{ route('admin.faculty_salary_tables.index') }}"
                            class="btn btn-danger ms-auto btn-sm">Manage</a>
                    @endif
                </div>

                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>This data was pulled as of 2/11/2025 from Core-CT.</strong>
                    <br>
                    Please note, salaries are full-time annual salaries as of 2/11/2025, reported as of 2/11/2025, derived from Core-CT. In other words, any changes or corrections that may have occurred after that date, even if retroactive to be effective before 2/11/2025, will not be reflected. All faculty are assigned to their home academic department, if applicable.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>

            <livewire:faculty-salary-tables />
        </div>
    </div>
@endsection
