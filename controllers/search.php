<?php

    require("models/search.php");
    $model = new Search();
    require("models/movies.php");
    $modelMovie = new Movie();
    
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(isset($_GET["filter"])) {
            $movies = $model->searchMovies($_GET["filter"]);
            shuffle($movies);
            require("views/search.php");
        }

        if(isset($_GET["genres"])) {
            $genres = $modelMovie->getGenres();
            $movies = $model->searchByGenre($_GET["genres"]);
            shuffle($movies);
            require("views/search.php");
        }
    }
?>