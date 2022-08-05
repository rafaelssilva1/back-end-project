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
                $_SESSION["message"] = "No results were found. Try another search.";
            } else {
                shuffle($movies);
            }

            require("views/search.php");
        }

        if(isset($_GET["genres"])) {
            $genres = $modelMovie->getGenres();
            $movies = $model->searchByGenre($_GET["genres"]);

            if(!$genres or !$movies) {
                $_SESSION["message"] = "There are no movies in this category.";
            } else {
                shuffle($movies);
            }

            require("views/search.php");
        }
    }

    else {
        http_response_code(405);
    }
    
?>