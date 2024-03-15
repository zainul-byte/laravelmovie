<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class FrontendController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        // Fetch new movies sorted by release date
        $newMovies = Movie::orderBy('release_date', 'desc')->take(5)->get();

        // Fetch all movies sorted by release date
        $allMovies = Movie::orderBy('release_date', 'desc')->get();

        return view('frontend.index', compact('newMovies', 'allMovies', 'movies'));
    }

    public function movieView($movie_slug)
    {
        // Retrieve the movie details by its slug
        $movie = Movie::where('slug', $movie_slug)->firstOrFail();

        // Load the ratings associated with the movie
        $ratings = Rating::where('movie_id', $movie->id)->with('user')->get();

        // Pass the movie details to the view
        return view('frontend.movie.view', compact('movie', 'ratings'));
    }

    public function genre()
    {
        $Movies = Movie::all();

        // Retrieve all unique genres from the movies table
        $moviesQuery = Movie::query();
        $columns = ['genre'];
        if (Schema::hasColumn('movies', 'genre2')) {
            $columns[] = 'genre2';
        }
        if (Schema::hasColumn('movies', 'genre1')) {
            $columns[] = 'genre1';
        }
        $movies = $moviesQuery->select($columns)->get();

        $allGenres = collect([]);

        foreach ($movies as $movie) {
            if ($movie->genre) {
                $allGenres->push($movie->genre);
            }
            if ($movie->genre1) {
                $allGenres->push($movie->genre1);
            }
            if ($movie->genre2) {
                $allGenres->push($movie->genre2);
            }
        }

        // Filter out null values and get unique genres
        $uniqueGenres = $allGenres->filter()->unique()->values();

        return view('frontend.genre.index', compact('Movies', 'uniqueGenres'));
    }

    public function movies_by_genre(Request $request)
    {
        $genre = trim($request->query('genre'));

        // Start with basic query filtering by genre
        $moviesQuery = Movie::where('genre', 'like', "%$genre%");

        // Check if genre2 and genre3 columns exist in the movies table
        $columns = ['genre'];
        if (Schema::hasColumn('movies', 'genre2')) {
            $columns[] = 'genre2';
        }
        if (Schema::hasColumn('movies', 'genre1')) {
            $columns[] = 'genre1';
        }

        // Include genre2 and genre3 in the search condition if they exist
        $moviesQuery->orWhere(function ($query) use ($columns, $genre) {
            foreach ($columns as $column) {
                $query->orWhereNotNull($column)->where($column, 'like', "%$genre%");
            }
        });

        // Retrieve the movies
        $movies = $moviesQuery->get();

        // Pass the movies data to the view
        return view('frontend.genre.selectedGenre', compact('movies', 'genre'));
    }

    public function performer()
    {
        $Movies = Movie::all();

        // Retrieve all unique performers from the movies table
        $moviesQuery = Movie::query();
        $columns = ['performer'];
        if (Schema::hasColumn('movies', 'performer2')) {
            $columns[] = 'performer2';
        }
        if (Schema::hasColumn('movies', 'performer1')) {
            $columns[] = 'performer1';
        }
        $movies = $moviesQuery->select($columns)->get();

        $allPerformer = collect([]);

        foreach ($movies as $movie) {
            if ($movie->performer) {
                $allPerformer->push($movie->performer);
            }
            if ($movie->performer1) {
                $allPerformer->push($movie->performer1);
            }
            if ($movie->performer2) {
                $allPerformer->push($movie->performer2);
            }
        }

        // Filter out null values and get unique genres
        $uniquePerformer = $allPerformer->filter()->unique()->sortBy(function ($performer) {
            return strtolower($performer);
        })->values();

        return view('frontend.performer.index', compact('Movies', 'uniquePerformer'));
    }

    public function movies_by_performer(Request $request)
    {
        $performer = trim($request->query('performer'));

        // Start with basic query filtering by genre
        $moviesQuery = Movie::where('performer', 'like', "%$performer%");

        // Check if genre2 and genre3 columns exist in the movies table
        $columns = ['performer'];
        if (Schema::hasColumn('movies', 'performer2')) {
            $columns[] = 'performer2';
        }
        if (Schema::hasColumn('movies', 'performer1')) {
            $columns[] = 'performer1';
        }

        // Include genre2 and genre3 in the search condition if they exist
        $moviesQuery->orWhere(function ($query) use ($columns, $performer) {
            foreach ($columns as $column) {
                $query->orWhereNotNull($column)->where($column, 'like', "%$performer%");
            }
        });

        // Retrieve the movies
        $movies = $moviesQuery->get();

        // Pass the movies data to the view
        return view('frontend.performer.selectedPerformer', compact('movies', 'performer'));
    }

    public function new_movies(Request $request)
    {
        // Retrieve the selected release date from the request
        $selectedDate = $request->input('release_date');

        // Check if a date is selected and parse it using Carbon
        if ($selectedDate) {
            $selectedDate = Carbon::parse($selectedDate)->toDateString();
        } else {
            // If no date is selected, default to today's date
            $selectedDate = Carbon::today()->toDateString();
        }

        // Retrieve movies released before the selected date
        $movies = Movie::whereDate('release_date', '<', $selectedDate)
        ->orderBy('release_date', 'desc') // Sort by release date in descending order
        ->get();

        return view('frontend.new_movies.index', compact('movies', 'selectedDate'));
    }

    public function searchMovies(Request $request)
    {
        if ($request->search) {
            $searchMovies = Movie::where('title', 'LIKE', '%' . $request->search . '%')
                                 ->latest()
                                 ->paginate(15);
            return view('frontend.search.index', compact('searchMovies'));
        } else {
            return redirect()->back()->with('message', 'No Movies Found.');
        }
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('message', 'Please login to continue.');
        }

        // Validate the request
        $validatedData = $request->validate([
            'rate' => 'required|integer|min:0|max:10',
            'comment' => 'nullable|string',
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Check if the user has already rated the movie
        $existingRating = Rating::where('user_id', Auth::id())
                                ->where('movie_id', $validatedData['movie_id'])
                                ->exists();

        if ($existingRating) {
            return redirect()->back()->with('message', 'You already rated this movie once.');
        }

        // Create and save the rating
        $rating = new Rating();
        $rating->user_id = Auth::id();
        $rating->movie_id = $validatedData['movie_id'];
        $rating->rate = $validatedData['rate'];
        $rating->comment = $validatedData['comment'];
        $rating->save();

        return redirect()->back()->with('message', 'Rating added successfully!');
    }

    public function destroy($rating_id)
    {
        Rating::findOrFail($rating_id)->delete();
        return redirect()->back()->with('message', 'Rating deleted successfully!');
    }
}
