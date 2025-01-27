@extends('layout')
@section('title', 'Show Institutional Priority')
@section('content')
<div class="py-5">
    <div class="container">
        <h1>Show Institutional Priority</h1>
        <p>Details of the institutional priority are shown below.</p>
        <div class="form-group">
            <label>Name</label>
            <p class="form-control-static">{{ $priority->name }}</p>
        </div>

        <div class="form-group">
            <label>Weight</label>
            <p class="form-control-static">{{ $priority->weight }}</p>
        </div>

        <div class="form-group">
            <label>Description</label>
            <div class="trix-content">{!! $priority->description !!}</div>
        </div>
    </div>
</div>
@endsection