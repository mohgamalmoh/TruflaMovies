<?php

namespace App\Console\Commands;

use App\Movie;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Response;

class FeedTopMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed_top_movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is a job that should be executed every {predefined} period to feed our db with {predefined_number} of top rated movies';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
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
    }
}
