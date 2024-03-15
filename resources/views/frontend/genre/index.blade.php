@extends('layouts.app')

@section('title', 'Genre')

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Filter Movie Genre</h4>
            </div>

            <div class="row">
                @forelse ($uniqueGenres as $genre)
                    <div class="row col-3 mb-1">
                        <a href="{{ url('/genre/movies_by_genre?genre='.$genre) }}" class="btn btn-primary">{{ $genre }}</a>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h5>No Genre Available</h5>
                    </div>
                @endforelse
            </div>

            <hr>
            @forelse ($Movies as $movie)
            <div class="col-6 col-md-3">
                <div class="movie-card">
                    <a href="{{ url('/movie/'.$movie->slug) }}">
                        <div class="movie-card-img">
                            <img src="{{$movie->image}}" class="w-100" alt="{{ $movie->title }}">
                        </div>
                        <div class="movie-card-body">
                            <h5>{{ $movie->title }}</h5>
                            <p>Genre:
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
