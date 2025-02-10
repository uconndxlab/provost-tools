@extends('layout')
@section('title', 'Create Institutional Priority')
@section('content')
<div class="py-5">
    <div class="container">
        <h1>Create Institutional Priority</h1>
        <p>Use the form below to create a new institutional priority.</p>
        <form action="{{ route('decision_maker.institutional_priorities.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

  
            <div class="form-group my-3">
                <label for="priority_level">Priority Level</label> <br>
                {{-- buttongroup from 1-5 --}}
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                    @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" class="btn-check" name="weight" id="priority_level{{ $i }}" value="{{ $i }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="priority_level{{ $i }}">{{ $i }}</label>
                    @endfor

                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control d-none" id="description" name="description" required></textarea>
                <trix-editor input="description"></trix-editor>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}">
                    <label class="form-check-label" for="tag{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-2">Create Priority</button>
        </form>
    </div>


    <script>
        // do a trix on the description field
        document.addEventListener('trix-file-accept', function (event) {
            event.preventDefault();
        })


        // 
    </script>

        

</div>
@endsection