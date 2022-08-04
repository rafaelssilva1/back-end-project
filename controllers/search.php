<?php

    require("models/search.php");
    $model = new Search();
    require("models/movies.php");
    $modelMovie = new Movie();
    
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(isset($_GET["filter"])) {
            $movies = $model->searchMovies($_GET["filter"]);

            if(!$movies) {
                http_response_code(500);
            } else {
                shuffle($movies);
            }

            require("views/search.php");
        }

        if(isset($_GET["genres"])) {
            $genres = $modelMovie->getGenres();
            $movies = $model->searchByGenre($_GET["genres"]);

            if(!$genres or !$movies) {
                http_response_code(500);
            } else {
                shuffle($movies);
            }

            require("views/search.php");
        }
    }
?>