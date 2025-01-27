@extends('layout')
@section('title', 'Edit Institutional Priority')
@section('content')
    <div class="py-5">
        <div class="container">
            <h1>Edit Institutional Priority</h1>
            <p>Use the form below to edit the institutional priority.</p>
            <form action="{{ route('decision_maker.institutional_priorities.update', $priority->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $priority->name }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" class="form-control" id="weight" name="weight" value="{{ $priority->weight }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control d-none" id="description" name="description" required>{{ $priority->description }}</textarea>
                    <trix-editor input="description"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}" {{ in_array($tag->id, $priorityTags ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tag{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>


                <button type="submit" class="btn btn-primary mt-2">Update Priority</button>
            </form>
        </div>

        <script>
            document.addEventListener('trix-file-accept', function(event) {
                event.preventDefault()
            })
        </script>
    </div>
@endsection
