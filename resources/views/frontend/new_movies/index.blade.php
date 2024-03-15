@extends('layouts.app')

@section('title', 'New Movies')

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('/new_movies/filter') }}" method="GET">
                    <div class="col-2 mb-1">
                        <label>Filter Movie Date</label>
                        <input type="date" name="release_date" class="form-control" value="{{ $selectedDate ? $selectedDate : date('Y-m-d') }}">
                    </div>
                    <div class="col-2 mb-1">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>

            @forelse ($movies as $movie)
            <div class="col-6 col-md-3">
                <div class="movie-card">
                    <a href="{{ url('/movie/'.$movie->slug) }}">
                        <div class="movie-card-img">
                            <img src="{{ asset($movie->image) }}" class="w-100" alt="{{ $movie->title }}">
                        </div>
                        <div class="movie-card-body">
                            <h5>{{ $movie->title }}</h5>
                            <p>Genre:
                                @if ($movie->genre)
                                {{ $movie->genre }}
                                    @if ($movie->genre1)
                                        , {{ $movie->genre1 }}
                                    @endif
                                    @if ($movie->genre2)
                                        , {{ $movie->genre2 }}
                                    @endif
                                @else
                                    No genre specified
                                @endif
                            <p>Length: {{ $movie->length }} minutes</p>
                        </div>
                    </a>
                </div>
            </div>
            @empty
                <div class="col-md-12">
                    <h5>No Movies Available</h5>
                </div>
            @endforelse

        </div>
    </div>
</div>

@endsection
