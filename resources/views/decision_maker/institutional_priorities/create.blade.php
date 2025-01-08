@extends('layout')
@section('title', 'Create Institutional Priority')
@section('content')
<div class="py-5">
    <div class="container">
        <h1>Create Institutional Priority</h1>
        <p>Use the form below to create a new institutional priority.</p>
        <form action="{{ route('institutional_priorities.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="priority">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight" required>
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Priority</button>
        </form>
    </div>
</div>
@endsection