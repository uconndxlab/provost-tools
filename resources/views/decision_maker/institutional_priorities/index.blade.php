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
            <ul class="nav nav-tabs mt-3" id="tagTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request('tag') ? '' : 'active' }}" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="{{ request('tag') ? 'false' : 'true' }}">All</a>
                </li>
                @foreach ($tags as $tag)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ request('tag') == $tag->id ? 'active' : '' }}" id="tag-{{ $tag->id }}-tab" data-bs-toggle="tab" href="#tag-{{ $tag->id }}" role="tab" aria-controls="tag-{{ $tag->id }}" aria-selected="{{ request('tag') == $tag->id ? 'true' : 'false' }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-3" id="tagTabContent">
                <div class="tab-pane fade {{ request('tag') ? '' : 'show active' }}" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Weight</th>
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
                                        <td>{!! $priority->description !!}</td>
                                        <td>
                                            <a href="{{ route('decision_maker.institutional_priorities.edit', $priority) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('decision_maker.institutional_priorities.destroy', $priority) }}" method="POST" style="display: inline;">
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
                @foreach ($tags as $tag)
                    <div class="tab-pane fade {{ request('tag') == $tag->id ? 'show active' : '' }}" id="tag-{{ $tag->id }}" role="tabpanel" aria-labelledby="tag-{{ $tag->id }}-tab">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tag->institutionalPriorities()->count() > 0)
                                        @foreach ($tag->institutionalPriorities as $priority)
                                            <tr>
                                                <td>{{ $priority->weight }}</td>
                                                <td>{{ $priority->name }}</td>
                                                <td>{!! $priority->description !!}</td>
                                                <td>
                                                    <a href="{{ route('decision_maker.institutional_priorities.edit', $priority) }}" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No priorities found for this tag.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
