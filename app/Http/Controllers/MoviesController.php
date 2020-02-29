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

    public function saveGenres(){
        return Genre::fetchAndSave();
    }

}
