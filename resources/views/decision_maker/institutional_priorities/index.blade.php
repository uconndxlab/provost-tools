@extends('layout')
@section('title', 'Institutional Priorities')
@section('content')
@include('decision_maker.parts.nav')

    <div class="py-5">
        <div class="container">
            <h1>Institutional Priorities</h1>
            <p>These are the institutional priorities that have been set for the organization.</p>
            <a href="{{ route('decision_maker.institutional_priorities.create') }}" class="btn btn-primary">Add Priority</a>

            {{-- lil form to filter by tag --}}
            <form action="{{ route('decision_maker.institutional_priorities.index') }}" method="GET">
                <div class="form-group mt-3">
                    <label for="tag">Filter by Tag</label>
                    <select name="tag" id="tag" class="form-control">
                        <option value="">All</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Priority</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($priorities as $priority)
                            <tr>
                                <td>{{ $priority->weight }}</td>
                                <td>{{ $priority->name }}</td>
                                {{-- the description may contain html --}}
                                <td>{!! $priority->description !!}</td>

                                <td>
                                    <a href="{{ route('decision_maker.institutional_priorities.edit', $priority) }}"
                                    class="btn btn-primary">Edit</a>
                                    <form action="{{ route('decision_maker.institutional_priorities.destroy', $priority) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
