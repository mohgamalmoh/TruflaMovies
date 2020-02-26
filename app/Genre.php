<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    public $timestamps = false;

    public function genres()
    {
        return $this->belongsToMany(Movie::class, 'movies_genres');
    }

    static function fetchAndSave(){

        //$ch = curl_init( "https://api.themoviedb.org/3/movie/top_rated?api_key=".env('TMDB_AUTH_KEY')."&language=en-US&page=".$page_num);
        $ch = curl_init( "https://api.themoviedb.org/3/genre/movie/list?api_key=".env('TMDB_AUTH_KEY')."&language=en-US");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result,true);
        //dd($response['genres'][0]['name']);
        /*foreach ($response['genres'] as $value){
            $genre = new Genre();
            $genre->id = $value['id'];
            $genre->name = $value['name'];
            $genre->save();
            dd($genre);

        }*/
        //dd($response['genres']);
        Genre::insert($response['genres']);
        return 'OK';
    }

}
