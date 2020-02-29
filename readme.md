## Tufla Movies
this is the simple app that seeds its data from TMDB , update the .env file<br/>
with your auth key and local database credentials<br/>
1-we can list our movies list in the database using this URL : {domain}/list-movies
the result set could be filtered using these parameters: <br/><br/>
  a- ?genre_id={integer value represinting a genre id}<br/><br/>
  b- ?title={string represents a movie name or part of it}<br/><br/>
  c- ?sortByPopularity=asc , this will sort the result set by popularity in ascending order<br/><br/>
  d- ?sortByPopularity=desc , this will sort the result set by popularity in descending order<br/><br/>
  e- ?sortByRate=asc , this will sort the result set in ascending order<br/><br/>
  f- ?sortByRate=desc , this will sort the result set in descending order
  and of course a mix of the above filters could be used.<br/><br/>
  g- the job that is responsible for feeding the database with the top rated movies list
     could be executed by the command "php artisan feed_top_movies"<br/><br/>
  h- the job that is responsible for feeding the database with the latest movie
        could be executed by the command "php artisan feed_latest_movie"<br/><br/>
  i- if you want to automate the database feeding process you must make a new cron entry 
     to the server like this one '* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1'
     , this will call the laravel scheduler every minute and laravel will run 
    the tasks that are due.<br/><br/>
  j- i uploaded the whole project without putting anything in the .gitignore file
     to avoid any configuration issue when you clone it, you need to just clone and run.<br/><br/>
  k- this repo will be updated with docker and docker-compose files to make it easy
     to run what is inside.<br/><br/>
