<?php

    require("models/search.php");
    $model = new Search();
    
    if(isset($_GET["filter"])) {
        $movies = $model->searchMovies($_GET["filter"]);
        shuffle($movies);
        require("views/search.php");
    }

    if(isset($_GET["genres"])) {
        $movies = $model->searchByGenre($_GET["genres"]);
        shuffle($movies);
        require("views/search.php");
    }
?>