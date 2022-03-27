<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Cinema;
use Illuminate\Support\Facades\Auth;
use File;

class MovieController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $movies = Movie::orderBy('title', 'asc')->get();

    $movies = Movie::orderBy('title', 'asc')
    ->when($request->query('title'), function($query) use ($request) {
    return $query->where('title', 'like', '%'.$request->query('title').'%');
    })
    ->when($request->query('genre'), function($query) use ($request) {
      return $query->where('genre', $request->query('genre'));
    })
    ->when($request->query('year'), function($query) use ($request) {
      return $query->where('year', $request->query('year'));
    })
    ->paginate(5);
    $user = Auth::user();
    return view('movie.index', [
    'movies' => $movies,
    'request' => $request,
    'isAdmin' => $user->roles == 'admin' ? true : false
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->authorize('isAdmin', Movie::class);
    $movie = new Movie();
    $cinemas = Cinema::pluck('name','id');

    return view('movie.create', [
    'movie' => $movie,
    'cinemas' => $cinemas,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->authorize('isAdmin', Movie::class);
    $this->validate($request, [
      'title' => 'required|unique:movies|max:100',
      'year' => 'required',
      'genre' => 'required',
      'box_office' => 'required|numeric',
      'synopsis' => 'required|max:1000',
    ]);

    $movie = new Movie;
    $movie->fill($request->all());
    $movie->save();

    $movie->cinemas()->sync($request->get('cinemas'));

    return redirect()->route('movie.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {

    $movie = Movie::find($id);
    if(!$movie) throw new ModelNotFoundException;

    $cinemas = Cinema::pluck('name','id');

    $movie = Movie::find($id);
    $cinemas = $movie->cinemas()->get();

    return view('movie.show', [
    'movie' => $movie,
    'cinemas' => $cinemas,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->authorize('isAdmin', Movie::class);
    $movie = Movie::find($id);
    if(!$movie) throw new ModelNotFoundException;

    $cinemas = Cinema::pluck('name','id');

    return view('movie.edit', [
    'movie' => $movie,
    'cinemas' => $cinemas,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->authorize('isAdmin', Movie::class);
    $movie = Movie::find($id);
    if(!$movie) throw new ModelNotFoundException;

    $this->validate($request, [
      'title' => 'required|max:100',
      'year' => 'required',
      'genre' => 'required',
      'synopsis' => 'required|max:1000',
    ]);

    $movie->fill($request->all());
    $movie->save();
    $movie->cinemas()->sync($request->get('cinemas'));

    return redirect()->route('movie.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->authorize('isAdmin', Movie::class);
    $movie = Movie::find($id);
    $movie->delete();
    return redirect()->route('movie.index')
                      ->with('success','Movie deleted successfully');
  }
}
