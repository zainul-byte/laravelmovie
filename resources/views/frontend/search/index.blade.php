@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Search Results</h2>
        </div>
    </div>
    <div class="row">
        @forelse ($searchMovies as $movie)
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
            <p>No movies found.</p>
        </div>
        @endforelse
    </div>
    <!-- Pagination links if needed -->
    {{ $searchMovies->links() }}
</div>
@endsection
