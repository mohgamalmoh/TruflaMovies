## Tufla Movies
this is the simple app that sedds its data drom TMDB 
1-we can list our movies list in the database using this URL : {domain}/list-movies
the result set could be filtered using these parameters:
  a- ?genre_id={integer value represinting a genre id}
  b- ?title={string represents a movie name or part of it}
  c- ?sortByPopularity=asc , this will sort the result set by popularity in ascending order
  d- ?sortByPopularity=desc , this will sort the result set by popularity in descending order
  e- ?sortByRate=asc , this will sort the result set in ascending order
  f- ?sortByRate=desc , this will sort the result set in descending order
  and of course a mix of the above filters could be used.
  g- the job that is responsible for feeding the database with the top rated movies list
     could be executed by the command "php artisan feed_top_movies"
  h- the job that is responsible for feeding the database with the latest movie
        could be executed by the command "php artisan feed_latest_movie"
  i- if you want to automate the database feeding process you must make a new cron entry 
     to the server like this one '* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1'
     , this will call the laravel scheduler every minute and laravel will run 
    the tasks that are due.
  j- i uploaded the whole project without putting anything in the .gitignore file
     to avoid any configuration issue when you clone it, you need to just clone and run.
  k- this repo will be updated with docker and docker-compose files to make it easy
     to run what is inside.