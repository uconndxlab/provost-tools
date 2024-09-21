@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Faculty Salary Tables</h3>
                        <p>Compare salaries with faculty in your department.</p>
                        <a href="{{ route('faculty_salary_tables.index') }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-bg-secondary">
                    <div class="card-body">
                        <h3>Commitment Tracker</h3>
                        <p>Track committments within your department.</p>
                        <a class="btn btn-primary disabled">Coming Soon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection