<?php

    require("models/watchlist.php");
    $model = new Watchlist();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $watchlist = $model->getAllWatchlist();
        shuffle($watchlist);
        require("views/watchlist.php");
    }
?>