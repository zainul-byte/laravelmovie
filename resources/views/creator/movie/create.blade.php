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
                <h3>Add Movie
                    <a href="{{ url('creator/movie')}}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('creator/movie') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"/>
                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control"/>
                            @error('slug')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Release Date</label>
                            <input type="date" name="release_date" class="form-control"/>
                            @error('release_date')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Length (in minutes)</label>
                            <input type="number" name="length" class="form-control"/>
                            @error('length')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>MPAA Rating</label>
                            <input type="text" name="mpaa_rating" class="form-control"/>
                            @error('mpaa_rating')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Genre</label>
                            <input type="text" name="genre" class="form-control"/>
                            @error('genre')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Genre 2 (optional)</label>
                            <input type="text" name="genre1" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Genre 3 (optional)</label>
                            <input type="text" name="genre2" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Director</label>
                            <input type="text" name="director" class="form-control"/>
                            @error('director')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Performer</label>
                            <input type="text" name="performer" class="form-control"/>
                            @error('performer')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Performer 2 (optional)</label>
                            <input type="text" name="performer1" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Performer 3 (optional)</label>
                            <input type="text" name="performer2" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Language</label>
                            <input type="text" name="language" class="form-control"/>
                            @error('language')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-warning float-end">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
