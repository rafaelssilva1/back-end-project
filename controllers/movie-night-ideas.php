<?php

    use ReallySimpleJWT\Token;

    require("models/movie-night-ideas.php");
    $model = new RandomMovie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        $random = $model->getRandomMovie();
        require("views/movie-night-ideas.php");
    }

?>