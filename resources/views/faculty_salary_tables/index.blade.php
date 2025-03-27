@extends('layout')
@section('title', 'Faculty Salary Tables')
@section('content')
<div class="py-5">
    <div class="container">
        <div class="mb-5">
            <div class="d-flex align-items-start">
                <h1>Faculty Salary Tables</h1>
                @if ( Auth::check() && Auth::user()->can_admin )
                    <a href="{{ route('admin.faculty_salary_tables.index') }}" class="btn btn-danger ms-auto btn-sm">Manage</a>
                @endif
            </div>
            
            <p>Compare salaries with faculty in your department.</p>
        </div>

        <livewire:faculty-salary-tables />
    </div>
</div>
@endsection