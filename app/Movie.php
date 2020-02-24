<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    static function fetchTopRatedPage($page_num){
        $ch = curl_init( "https://api.themoviedb.org/3/movie/top_rated?api_key=".env('TMDB_AUTH_KEY')."&language=en-US&page=".$page_num);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result,true);
        return $response;
    }

    static function fetchLatest($page_num){
        $ch = curl_init( "https://api.themoviedb.org/3/movie/latest?api_key=".env('TMDB_AUTH_KEY')."&language=en-US&page=".$page_num);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result,true);
        return $response;
    }

    static function saveJSONMovie($json_movie){

    }
}
