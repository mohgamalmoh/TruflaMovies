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
        return $this->belongsToMany(Genre::class, 'movies_genres','movie_id','genre_id');
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

    static function saveJSONMovie($json_movie,$page=null,$type){

        $movie = new Movie();
        $movie->tmdb_id = $json_movie['id'];
        $movie->popularity = $json_movie['popularity'];
        $movie->vote_average = $json_movie['vote_average'];
        $movie->title = $json_movie['original_title'];
        $movie->release_date = $json_movie['release_date'];
        $movie->page = $page;
        $movie->created_at = Carbon::now()->toDateTimeString();
        $movie->save();

        if($type == 'top'){
            foreach ($json_movie['genre_ids'] as $value){
                $movies_genres = new MoviesGenres();
                $movies_genres->movie_id = $movie->id;
                $movies_genres->genre_id = $value;
                $movies_genres->save();
            }
        }else{
            foreach ($json_movie['genres'] as $value){
                if(is_int($value)){
                    $movies_genres = new MoviesGenres();
                    $movies_genres->movie_id = $movie->id;
                    $movies_genres->genre_id = $value;
                    $movies_genres->save();
                }

            }
        }
    }

    static function listMovies($inputs){
        $movies = new self();

        if(isset($inputs['genre_id']) && $inputs['genre_id'] != ''){
            $movies = $movies->whereHas('genres', function ($query) use ($inputs) {
                $query->where('genres.id', $inputs['genre_id']);
            });
        }

        if(isset($inputs['title']) && $inputs['title'] != ''){
            $movies = $movies->where('title', 'LIKE' , '%'.$inputs['title'].'%' );
        }

        if(isset($inputs['sortByPopularity']) && $inputs['sortByPopularity'] == 'desc'){
            $movies = $movies->orderBy('popularity','desc');
        }

        if(isset($inputs['sortByPopularity']) && $inputs['sortByPopularity'] == 'asc'){
            $movies = $movies->orderBy('popularity','asc');
        }

        if(isset($inputs['sortByRate']) && $inputs['sortByRate'] == 'desc'){
            $movies = $movies->orderBy('vote_average','desc');
        }

        if(isset($inputs['sortByRate']) && $inputs['sortByRate'] == 'asc'){
            $movies = $movies->orderBy('vote_average','asc');
        }

        $movies = $movies->with('genres');
        $movies = $movies->get();

        return $movies;
    }
}
