@extends('layouts.app')

@section('title', $movie->title)

@section('content')

<div class="py-3 py-md-5">
    <div class="container">

        @if (session()->has('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white border">
                    <img src="{{ asset($movie->image) }}" class="w-100" alt="{{ $movie->title }}">
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $movie->title }}
                    </h4>
                    <hr>
                    <div>
                        <!-- Display only the first genre if it exists -->
                        @if($movie->genre)
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
                            </p>
                        @endif
                        <!-- Display performer if it exists -->
                        @if($movie->performer)
                            <p>Performer:
                                @if ($movie->performer)
                                {{ $movie->performer }}
                                    @if ($movie->performer2)
                                        , {{ $movie->performer2 }}
                                    @endif
                                    @if ($movie->performer1)
                                        , {{ $movie->performer1 }}
                                    @endif
                                @else
                                    No genre specified
                                @endif
                            </p>
                        @endif
                        <!-- Display MPAA rating if it exists -->
                        @if($movie->mpaa_rating)
                            <p>MPAA Rating: {{ $movie->mpaa_rating }}</p>
                        @endif
                        <!-- Display release date if it exists -->
                        @if($movie->release_date)
                            <p>Release Date: {{ $movie->release_date->format('M d, Y') }}</p>
                        @endif
                        <!-- Display director if it exists -->
                        @if($movie->director)
                            <p>Director: {{ $movie->director }}</p>
                        @endif
                        <!-- Display language if it exists -->
                        @if($movie->language)
                            <p>Language: {{ $movie->language }}</p>
                        @endif
                        <p>Length: {{ $movie->length }} minutes</p>
                    </div>
                    <!-- Add more movie details as needed -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Description</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $movie->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="row mt-5">

                <!-- Form for new comment -->
                <div class="card mt-3 mb-1">
                    <div class="card-header bg-white">
                        <h5>Leave a Comment</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/movie') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Rating (0-10):</label>
                                <select class="form-control" name="rate">
                                    @for ($i = 10; $i >= 0; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Your Comment:</label>
                                <textarea class="form-control" name="comment" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            <div class="col-md-12">
                <h4>Comments</h4>
                <hr>

                <!-- Display all comments -->
                @if ($ratings->isNotEmpty())
                    @foreach ($ratings as $rating)
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="comment">
                                <div class="mb-2">
                                    <strong>User:</strong> {{ $rating->user->name }}
                                    @if ($rating->user_id == auth()->id())
                                        <span class="float-end">
                                            <a href="{{ url('movie/'.$rating->id.'/delete') }}" onclick="return confirm('Delete this rating?')" class="btn btn-danger">Delete</a>
                                        </span>
                                    @endif
                                </div>
                                <hr>
                                <div class="mb-2">
                                    <strong>Rating:</strong> {{ $rating->rate }} <span>/ 10</span>
                                </div>
                                <div>
                                    <strong>Comment:</strong> {{ $rating->comment }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>No comments available.</p>
                @endif

            </div>
        </div>


    </div>
</div>

@endsection
