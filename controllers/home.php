<?php

    require("models/home.php");
    $model = new Home();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $heroMovies = $model->getRandomMovies();
        $popularMovies = $model->getPopularMovies();
        $topRatedMovies = $model->getTopRatedMovies();
        $upcomingMovies = $model->getUpcomingMovies();
        require("views/home.php");
    }

?>