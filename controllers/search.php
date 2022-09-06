<?php

    require("models/search.php");
    $model = new Search();
    require("models/movies.php");
    $modelMovie = new Movie();

    $page = 2;
    $offset = 0;
    $maxOffset = 0;
    $targetOffset = 12;
    if(isset($_GET["genres"])) {
        $moviesCount = $model->getMoviesCountByGenre($_GET["genres"]); 
    } else {
        $moviesCount = $model->countMoviesFromSearch($_GET["filter"]);
    }
    $disableNext = false;
    $disablePrevious = false;
    
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(!isset($_GET["page"]) and isset($_GET["filter"])) {
            if (
                mb_strlen($_GET["filter"]) < 0 or
                mb_strlen($_GET["filter"]) > 65535
            ) {
                http_response_code(400);
                die();
            }
            
            $movies = $model->searchMovies($_GET["filter"], $offset);

            if(!$movies) {
                $message = "No results were found. Try another search.";
            }

            require("views/search.php");
        } else if(isset($_GET["page"]) and isset($_GET["filter"])) {
            if($_GET["page"] <= 0) {
                $_GET["page"] = 1;
            }
            if($_GET["page"] > ceil($moviesCount["count"] / $targetOffset)) {
                $_GET["page"]  = ceil($moviesCount["count"] / $targetOffset);
            }
            if(ceil($moviesCount["count"] / $targetOffset) == ($_GET["page"])) {
                $page = $_GET["page"] + 1;
                $offset = $offset + $targetOffset;
                $offset = $offset * ($page - 2);
                $maxOffset = $offset + $targetOffset; 
                $movies = $model->searchMovies($_GET["filter"], $offset);
                $disableNext = true;
                require("views/search.php");
            } else {
                $page = $_GET["page"] + 1;
                $offset = $offset + $targetOffset;
                $offset = $offset * ($page - 2);
                $maxOffset = $offset + $targetOffset; 
                $movies = $model->searchMovies($_GET["filter"], $offset);
                require("views/search.php");
            }
        }

        if(!isset($_GET["page"]) and isset($_GET["genres"])) {
            $genres = $modelMovie->getGenres();
            $movies = $model->getMoviesByGenre($offset, $_GET["genres"]);

            if(!$movies) {
                $message = "There are no movies in this category.";
            }

            require("views/search.php");
        } else if(isset($_GET["page"]) and isset($_GET["genres"])) {
            if($_GET["page"] <= 0) {
                $_GET["page"] = 1;
            }
            if($_GET["page"] > ceil($moviesCount["count"] / $targetOffset)) {
                $_GET["page"]  = ceil($moviesCount["count"] / $targetOffset);
            }
            if(ceil($moviesCount["count"] / $targetOffset) == ($_GET["page"])) {
                $page = $_GET["page"] + 1;
                $offset = $offset + $targetOffset;
                $offset = $offset * ($page - 2);
                $maxOffset = $offset + $targetOffset; 
                $movies = $model->getMoviesByGenre($offset, $_GET["genres"]);
                $genres = $modelMovie->getGenres();
                $disableNext = true;
                require("views/search.php");
            } else {
                $page = $_GET["page"] + 1;
                $offset = $offset + $targetOffset;
                $offset = $offset * ($page - 2);
                $maxOffset = $offset + $targetOffset; 
                $movies = $model->getMoviesByGenre($offset, $_GET["genres"]);
                $genres = $modelMovie->getGenres();
                require("views/search.php");
            }
        }
    }

    else {
        http_response_code(405);
    }
    
?>