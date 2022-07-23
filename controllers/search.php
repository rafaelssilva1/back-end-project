<?php

    require("models/search.php");
    $model = new Search();
    
    if(isset($_GET["filter"])) {
        $movies = $model->searchMovies($_GET["filter"]);
        require("views/search.php");
    }
?>