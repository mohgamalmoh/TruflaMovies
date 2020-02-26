<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    public $timestamps = false;

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movies_genres');
    }

    static function fetchTopRatedPage($page_num){

            $ch = curl_init( "https://api.themoviedb.org/3/movie/top_rated?api_key=".env('TMDB_AUTH_KEY')."&language=en-US&page=".$page_num);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result,true);
            return $response;
    }

    static function fetchLatest(){
        $ch = curl_init( "https://api.themoviedb.org/3/movie/latest?api_key=".env('TMDB_AUTH_KEY')."&language=en-US");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result,true);

        return $response;
    }

    static function saveJSONMovie($json_movie){

        $movie = new Movie();
        $movie->tmdb_id = $json_movie['id'];
        $movie->popularity = $json_movie['popularity'];
        $movie->vote_average = $json_movie['vote_average'];
        $movie->title = $json_movie['original_title'];
        $movie->release_date = $json_movie['release_date'];
        $movie->created_at = Carbon::now()->toDateTimeString();
        $movie->save();

        foreach ($json_movie['genre_ids'] as $value){
            $movies_genres = new MoviesGenres();
            $movies_genres->movie_id = $movie->id;
            $movies_genres->genre_id = $value;
            $movies_genres->save();
        }


    }
}
