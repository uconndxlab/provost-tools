@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mb-5">
            <h1>Faculty Salary Tables</h1>
            <p>Compare salaries with faculty in your department.</p>
        </div>

        <livewire:faculty-salary-tables />
    </div>
</div>
@endsection