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
        $userPayload = $model->checkAuthToken();
        $movie = $model->getMovieById($id);
    
        if(!empty($id)) {
            if(empty($movie["id"])) {
                http_response_code(404);
                require("views/404.php");
            } else {
                if(!empty($userPayload)) {
                    $movie = $model->getMovieById($id);
                    $heart = $model->searchWatchlist($id, $userPayload["user_id"]);
                    $comments = $model->getComments($id);
                    $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
                } else {
                    $movie = $model->getMovieById($id);
                    $comments = $model->getComments($id);
                }
                require("views/movieById.php");
            }
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
        if(isset($_POST["comment_text"]) and isset($_POST["rating"])) {
            $userPayload = $model->checkAuthToken();

            if(empty($userPayload)) {
                header("Location: /movies/".$_POST["movie_id"]);
            }

            if (
                empty($_POST) or
                mb_strlen($_POST["comment_text"]) < 0 or
                mb_strlen($_POST["comment_text"]) > 65535 or
                intval($_POST["rating"]) < 1 or
                intval($_POST["rating"]) > 10
            ) {
                http_response_code(405);
                header("Location: /movies/".$id);
            }

            $data = $model->postComments($_POST["movie_id"], $userPayload["user_id"], $_POST["comment_text"], $_POST["rating"]);

            http_response_code(202);
            header("Location: /movies/".$_POST["movie_id"]);
        }
        
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        if(isset($data["watchlist"])) {
            $userPayload = $model->checkAuthToken();

            if(empty($userPayload)) {
                header("Location: /movies/".$id);
            }

            if(
                empty($data)
            ) {
                http_response_code(400);
                exit;
            }

            $saved = $model->searchWatchlist($data["movie_id"], $userPayload["user_id"]);
    
            if(empty($saved)) {
                $data = $model->postToWatchlist($data["movie_id"], $userPayload["user_id"]);
                http_response_code(202);
            }
        }

    }

    if( $_SERVER["REQUEST_METHOD"] === "DELETE" ) {
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);
        
        if(isset($data["watchlist"])) {
            $userPayload = $model->checkAuthToken();

            if(empty($userPayload)) {
                header("Location: /movies/".$id);
            }

            $saved = $model->searchWatchlist($data["movie_id"], $userPayload["user_id"]);

            if(!empty($saved)) {
                $data = $model->deleteFromWatchlist($data["movie_id"], $userPayload["user_id"]);
            }
        } else if(isset($data["deleteMovie"])) {
            $searchMovie = $model->getMovieById($data["movie_id"]);

            if(!empty($searchMovie)) {
                $data = $model->deleteMovie($data["movie_id"]);
            }
        }

    }
?>