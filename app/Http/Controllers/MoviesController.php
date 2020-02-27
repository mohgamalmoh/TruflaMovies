<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class MoviesController extends Controller
{


   /* public function fetchTopRatedPage()
    {
        $last_page = Movie::max('page');
        $start_page = isset($last_page) ? ((int) $last_page+1) : 1;
        if($start_page > 347){
            $response = new \stdClass();
            $response->status = new \stdClass();
            $response->status->message = 'the end';
            $response->status->status = true;
            $response->status->code = 200;
            return Response::json($response, 200);
        }
        //dd($start_page);
        $num_of_records = (int) env("NUM_OF_RECORDS",40);
        $pages_count = ceil($num_of_records / 20); //getting the number of pages that we should fetch, as each page contains 20 items
        $end_page = (int) ($start_page + $pages_count - 1);

        for($i=$start_page ; $i <= $end_page ; $i++){
            $response  = Movie::fetchTopRatedPage($i);
            foreach ($response["results"] as $movie) {
                Movie::saveJSONMovie($movie,$i,'top');
            }

        }
        //echo '100';
        $response = new \stdClass();
        $response->status = new \stdClass();
        $response->status->message = 'success';
        $response->status->status = true;
        $response->status->code = 200;
        return Response::json($response, 200);

        //return $response;
    }*/

    /*public function fetchLatest(){
        $movie =  Movie::fetchLatest();
        Movie::saveJSONMovie($movie,null,'latest');

        $response = new \stdClass();
        $response->status = new \stdClass();
        $response->status->message = 'success';
        $response->status->status = true;
        $response->status->code = 200;
        return Response::json($response, 200);
    }*/

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
        $inputs = Input::all();
        $result = Movie::listMovies($inputs);

        if(count($result) > 0){
            $response['status'] = new \stdClass();
            $response['status']->message = 'success';
            $response['status']->status = true;
            $response['status']->code = 200;
            $response['data'] = $result;
            return Response::json($response, 200);
        }else{
            $response['status'] = new \stdClass();
            $response['status']->message = 'no data';
            $response['status']->code = 204;
            $response['data'] = $result;
            return Response::json($response, 204);
        }

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
