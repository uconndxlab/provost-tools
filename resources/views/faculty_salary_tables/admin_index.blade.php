@extends('layout')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="mb-5">
            <h1>Faculty Salary Tables Management</h1>
            <p>Manage the data behind the faculty salary tables page.</p>
        </div>

        <div class="card mb-5">
            <div class="card-header"><h2 class="fs-4 mb-0">Upload User Payroll &amp; NetIDs</h2></div>
            <div class="card-body">
                <livewire:upload-payroll-netid />
            </div>
        </div>
        


        <div class="card mb-5">
            <div class="card-header"><h2 class="fs-4 mb-0">Upload Faculty Salary Entries</h2></div>
            <div class="card-body">
                <livewire:upload-faculty-salary-tables />
            </div>
        </div>


        <livewire:faculty-salary-tables />
    </div>
</div>
@endsection