<?php

    use ReallySimpleJWT\Token;

    require("models/movies.php");
    $model = new Movie();
    require("models/users.php");
    $modelUser = new User();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }
        $genres = $model->getGenres();
        $getMovies = $model->getMovies();

        if(!empty($id)) {
            $movie = $model->getMovieById($id);
        }

        $users = $modelUser->getUsers();

        require("views/admin.php");
    }

    else if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();
        $genresCount = $model->getGenresCount();
        
        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }
        if(isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["overview"]) and isset($_POST["release_date"]) and isset($_POST["duration"]) and isset($_POST["genres_id"]) and isset($_POST["trailer_link"]) and isset($_POST["backdrop_path"]) and isset($_POST["poster_path"])) {
            $date = explode('-', $_POST["release_date"]);
            if (
                empty($_POST) or
                mb_strlen($_POST["title"]) < 0 or
                mb_strlen($_POST["title"]) > 64 or
                mb_strlen($_POST["overview"]) < 0 or
                mb_strlen($_POST["overview"]) > 65535 or
                !checkdate($date[1], $date[2], $date[0]) or
                intval($_POST["duration"]) < 1 or
                intval($_POST["duration"]) > 65535 or
                intval($_POST["genres_id"]) < 1 or
                intval($_POST["genres_id"]) > $genresCount or
                mb_strlen($_POST["trailer_link"]) != 11 or
                mb_strlen($_POST["backdrop_path"]) < 0 or
                mb_strlen($_POST["backdrop_path"]) > 240 or
                mb_strlen($_POST["poster_path"]) < 0 or
                mb_strlen($_POST["poster_path"]) > 240
            ) {
                http_response_code(400);
                $_SESSION['message'] = "You have entered invalid information. Please try again.";
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
                die();
            }
            
            $updateMovie = $model->editMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], $_POST["backdrop_path"], $_POST["poster_path"], $_POST["id"]);

            if(!$updateMovie) {
                $_SESSION['message'] = "An error has occurred. Please try again.";
                http_response_code(500);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            } else {
                $_SESSION['message'] = "Movie edited successfully.";
                http_response_code(202);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            }

        } else {
            if (
                empty($_POST) or
                mb_strlen($_POST["title"]) < 0 or
                mb_strlen($_POST["title"]) > 64 or
                mb_strlen($_POST["overview"]) < 0 or
                mb_strlen($_POST["overview"]) > 65535 or
                !checkdate($date[1], $date[2], $date[0]) or
                intval($_POST["duration"]) < 1 or
                intval($_POST["duration"]) > 65535 or
                intval($_POST["genres_id"]) < 1 or
                intval($_POST["genres_id"]) > $genresCount or
                mb_strlen($_POST["trailer_link"]) != 11 or
                mb_strlen($_POST["backdrop_path"]) < 0 or
                mb_strlen($_POST["backdrop_path"]) > 240 or
                mb_strlen($_POST["poster_path"]) < 0 or
                mb_strlen($_POST["poster_path"]) > 240
            ) {
                http_response_code(400);
                $_SESSION['message'] = "You have entered invalid information. Please try again.";
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
                die();
            }
            
            $createMovie = $model->createMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], $_POST["backdrop_path"], $_POST["poster_path"]);
            
            if(!$createMovie) {
                $_SESSION['message'] = "An error has occurred. Please try again.";
                http_response_code(500);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            } else {
                http_response_code(202);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            }
        }
    }

    else {
        http_response_code(405);
    }

?>