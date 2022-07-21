<?php

    require("models/movies.php");
    $model = new Movie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
    
        if(!empty($id)) {
            $movie = $model->getMovieById($id);
            require("views/movieById.php");
        } else {
            $movies = $model->getAll();
            require("views/movies.php");
        }
    }
?>