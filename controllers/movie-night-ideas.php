<?php

    require("models/movie-night-ideas.php");
    $model = new RandomMovie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $random = $model->getRandomMovie();
        require("views/movie-night-ideas.php");
    }

?>