<?php

namespace App\Console\Commands;

use App\Movie;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Response;

class FeedLatestMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed_latest_movie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is a job that should be executed every {predefined} period to feed our db with the latest movie';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $movie =  Movie::fetchLatest();
        Movie::saveJSONMovie($movie,null,'latest');

        $response = new \stdClass();
        $response->status = new \stdClass();
        $response->status->message = 'success';
        $response->status->status = true;
        $response->status->code = 200;
        return Response::json($response, 200);
    }
}
