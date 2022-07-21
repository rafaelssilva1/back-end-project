<?php

    require("models/movies.php");
    $model = new Movie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
    
        $movies = $model->getAll();

        require("views/movies.php");
    }
?>