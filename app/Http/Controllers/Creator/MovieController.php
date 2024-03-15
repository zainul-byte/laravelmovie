<?php

namespace App\Http\Controllers\Creator;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\MovieFormRequest;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);
        return view('creator.movie.index', compact('movies'));
    }

    public function create()
    {
        return view('creator.movie.create');
    }

    public function store(MovieFormRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'release_date' => ['required', 'date'],
            'length' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'mpaa_rating' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'genre' => ['required', 'string'],
            'genre1' => ['nullable', 'string'],
            'genre2' => ['nullable', 'string'],
            'director' => ['required', 'string'],
            'performer' => ['required', 'string'],
            'performer1' => ['nullable', 'string'],
            'performer2' => ['nullable', 'string'],
            'language' => ['required', 'string'],
        ]);
        $slug = Str::slug($validatedData['title']);
        $validatedData['slug'] = $slug;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/movies'), $imageName);
            $validatedData['image'] = 'uploads/movies/'.$imageName;
        }

        // Create a new movie instance and fill it with validated data
        $movie = new Movie;
        $movie->fill($validatedData);
        $movie->save();

        return redirect('creator/movie')->with('message', 'Movie added successfully');
    }

    public function edit(Movie $movie)
    {
        return view('creator.movie.edit', compact('movie'));
    }

    public function update(MovieFormRequest $request, $movie)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'release_date' => ['required', 'date'],
            'length' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'mpaa_rating' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'genre' => ['required', 'string'],
            'genre1' => ['nullable', 'string'],
            'genre2' => ['nullable', 'string'],
            'director' => ['required', 'string'],
            'performer' => ['required', 'string'],
            'performer1' => ['nullable', 'string'],
            'performer2' => ['nullable', 'string'],
            'language' => ['required', 'string'],
        ]);
        $slug = Str::slug($validatedData['title']);
        $validatedData['slug'] = $slug;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/movies'), $imageName);
            $validatedData['image'] = 'uploads/movies/'.$imageName;
        }

        // Update the movie with validated data
        $movie = Movie::findOrFail($movie);
        $movie->update($validatedData);

        return redirect('creator/movie')->with('message', 'Movie updated successfully');
    }

    public function destroy($movie)
    {
        // Find the movie
        $movie = Movie::findOrFail($movie);

        // Check if the movie has an associated image
        if ($movie->image) {
            if (File::exists($movie->image)) {
                File::delete($movie->image);
            }
        }

        // Delete the movie
        $movie->delete();

        return redirect('creator/movie')->with('message', 'Movie deleted successfully');
    }
}
