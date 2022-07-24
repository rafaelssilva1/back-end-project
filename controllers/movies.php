<?php

    require("models/movies.php");
    $model = new Movie();

    $page = 2;
    $offset = 0;
    $maxOffset = 0;
    $targetOffset = 12;
    $moviesCount = $model->getMoviesCount();
    $disableNext = false;
    $disablePrevious = false;

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
    
        if(!empty($id)) {
            $movie = $model->getMovieById($id);
            $heart = $model->searchWatchlist($id, 1); // ATTENTION CHANGE LATER
            require("views/movieById.php");
        } else {
            if(!isset($_GET["page"])) {
                $movies = $model->getAll($offset);
                shuffle($movies);
                $genres = $model->getGenres();
                $disablePrevious = true;
                require("views/movies.php");
            } else {
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
                    $movies = $model->getAll($offset);
                    shuffle($movies);
                    $genres = $model->getGenres();
                    $disableNext = true;
                    require("views/movies.php");
                } else {
                    $page = $_GET["page"] + 1;
                    $offset = $offset + $targetOffset;
                    $offset = $offset * ($page - 2);
                    $maxOffset = $offset + $targetOffset; 
                    $movies = $model->getAll($offset);
                    shuffle($movies);
                    $genres = $model->getGenres();
                    require("views/movies.php");
                }
            }
        }
    }

    if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        if(
            empty($data) ||
            !is_numeric($data["movie_id"]) ||
            !is_numeric($data["user_id"])
        ) {
            http_response_code(400);
            echo '{"Message":"Invalid information"}';
            exit;
        }

        $saved = $model->searchWatchlist($data["movie_id"], $data["user_id"]);

        if(empty($saved)) {
            $data = $model->postToWatchlist($data["movie_id"], $data["user_id"]);
            http_response_code(202);
            echo '{"Message":"Movie added to watchlist"}';
            echo json_encode($data);
        } else {
            http_response_code(202);
            echo '{"Message":"Movie already exists in watchlist"}';
        }
    }
?>