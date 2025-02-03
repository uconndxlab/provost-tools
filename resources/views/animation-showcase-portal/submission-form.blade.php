@extends('layout')
@section('title', 'Contact')
@section('content')
<div class="hero text-center text-white py-5">
    <div class="container">
        <h1>2025 Big East Animation Showcase
        </h1>
        <h2>Submit a thingy</h2>
    </div>
</div>
<div class="content-wrap">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="file">Upload File</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection