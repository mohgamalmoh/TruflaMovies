<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MoviesGenres extends Model
{
    protected $table = 'movies_genres';
    public $timestamps = false;

}
