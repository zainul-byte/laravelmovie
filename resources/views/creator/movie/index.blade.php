@extends('layouts.creator')

@section('title', 'Movies')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Movie(s)
                    <a href="{{ url('creator/movie/create')}}" class="btn btn-primary btn-sm text-white float-end">Add Movie</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Release</th>
                            <th>Length(Min)</th>
                            <th>MPAA Rating</th>
                            <th>Genre</th>
                            <th>Director</th>
                            <th>Performer</th>
                            <th>Language</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movies as $movie)
                        <tr>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->release_date->format('Y-m-d') }}</td>
                            <td>{{ $movie->length }}</td>
                            <td>{{ $movie->mpaa_rating }}</td>
                            <td>
                                @if ($movie->genre)
                                {{ $movie->genre }},
                                    @if ($movie->genre1)
                                        {{ $movie->genre1 }},
                                    @endif
                                    @if ($movie->genre2)
                                        {{ $movie->genre2 }}
                                    @endif
                                @else
                                    No genre specified
                                @endif
                            </td>
                            <td>{{ $movie->director }}</td>
                            <td>
                                @if ($movie->performer)
                                {{ $movie->performer }},
                                    @if ($movie->performer1)
                                        {{ $movie->performer1 }},
                                    @endif
                                    @if ($movie->performer2)
                                        {{ $movie->performer2 }}
                                    @endif
                                @else
                                    No performer specified
                                @endif
                            </td>
                            <td>{{ $movie->language }}</td>
                            <td>
                                <a href="{{ url('creator/movie/'.$movie->id.'/edit') }}" class="btn btn-success">Edit</a>
                                <a href="{{ url('creator/movie/'.$movie->id.'/delete') }}" onclick="return confirm('Are sure you want to delete this data?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">No Movies Added Yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $movies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
