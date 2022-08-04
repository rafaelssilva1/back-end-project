<?php

    require("models/watchlist.php");
    $model = new Watchlist();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(empty($userPayload)) {
            header("Location: /movies/");
        }

        $watchlist = $model->getAllWatchlist($userPayload["user_id"]);

        if(!$watchlist) {
            http_response_code(500);
        } else {
            shuffle($watchlist);
        }
        require("views/watchlist.php");
    }
?>