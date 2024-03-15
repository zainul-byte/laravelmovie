@extends('layouts.app')

@section('title', $performer.' Movies')

@section('content')
<div class="container">
    <h2>Movies by Performer: {{ $performer }}</h2>
    <hr>

    <div class="row">
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
                            @endif
                            @if ($movie->genre2)
                                , {{ $movie->genre2 }}
                            @endif
                            @if ($movie->genre1)
                                , {{ $movie->genre1 }}
                            @endif
                        </p>
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
@endsection
