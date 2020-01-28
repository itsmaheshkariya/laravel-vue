<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
class MovieController extends Controller
{
    public function getAll(){
        return response()->json(Movie::get());
    }
    public function getOne($id){
        return response()->json(Movie::find($id));
    }
    public function delete($id){
        return response()->json(Movie::destroy($id));
    }
    public function update(Request $request,$id){
        $movie = Movie::find($id);
        $movie->title = $request->input('title');
        $movie->link = $request->input('link');
        $movie->save();
        return response()->json($movie);
    }
    public function post(Request $request){
        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->link = $request->input('link');
        $movie->save();
        return response()->json($movie);
    }
}
