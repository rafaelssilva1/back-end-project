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

    if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();
        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }
        if(empty($id) and isset($_POST["title"]) and isset($_POST["overview"]) and isset($_POST["release_date"]) and isset($_POST["duration"]) and isset($_POST["genres_id"]) and isset($_POST["trailer_link"]) and isset($_POST["backdrop_path"]) and isset($_POST["poster_path"])) {
            $createMovie = $model->createMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], $_POST["backdrop_path"], $_POST["poster_path"]);
            header("Location: /admin/");
        } else {
            $updateMovie = $model->editMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], $_POST["backdrop_path"], $_POST["poster_path"], $id);
            header("Location: /movies/".$id);
        }
    }

?>