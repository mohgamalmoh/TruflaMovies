<?php

namespace App\Console;

use App\Console\Commands\FeedLatestMovie;
use App\Console\Commands\FeedTopMovies;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        FeedTopMovies::class,
        FeedLatestMovie::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('feed_top_movies')->cron('0 */'.env('INTERVAL_HOURS',2).' * * *');
        $schedule->command('feed_latest_movie')->cron('0 */'.env('INTERVAL_HOURS',2).' * * *');
    }
}
