<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MoviesController extends Controller
{


    public function fetchTopRatedPage()
    {
        $start_page = 1; //var
        $num_of_records = (int) env("NUM_OF_RECORDS",40);
        $pages_count = ceil($num_of_records / 20); //getting the number of pages that we should fetch, as each page contains 20 items
        $end_page = (int) ($start_page + $pages_count - 1);

        for($i=$start_page ; $i <= $end_page ; $i++){
            $response  = Movie::fetchTopRatedPage($i);
            foreach ($response["results"] as $movie) {
                Movie::saveJSONMovie($movie);
            }

        }
        //echo '100';
        /*$response = new \stdClass();
        $response->status = new \stdClass();
        $response->status->message = 'success';
        $response->status->status = true;
        $response->status->code = 200;*/

        /*return Response::json(array(
            'code'      =>  404,
            'message'   =>  '$message'
        ), 404);*/

        //return true;
    }

    public function fetchLatest(){
        $movie =  Movie::fetchLatest();
        Movie::saveJSONMovie($movie);
        return '200';
    }

    public function saveGenres(){
        return Genre::fetchAndSave();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listMovies()
    {
        dd(45);
        $inputs = Input::all();
        $movies = new Movie();

       /* if(isset($inputs['genre_id']) && $inputs['genre_id'] != ''){
            $movies->whereHas('genres', function ($query) use ($inputs) {
                $query->where('id', $inputs['genre_id']);
            });
        }

        if(isset($inputs['title']) && $inputs['title'] != ''){
            $movies->where('title',  $inputs['title'] );
        }*/

        $movies->where('id','5');
        $result = $movies->get();
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
