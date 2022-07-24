<?php

define("ENV", parse_ini_file(".env"));

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$resource = $parts[1] ;

$id = $parts[2] ?? "";

$controllers = ["movies", "movie-night-ideas", "watchlist", "search", "login", "admin"];

require_once("models/base.php");

if(empty($resource)) {
    require("controllers/home.php");
} else if(isset($_GET["page"])) {
    require("controllers/movies.php");
} else if(!in_array($resource, $controllers) and !isset($_GET["page"])) {
    require("views/404.php");
} else {
    require("controllers/" .$resource. ".php");
}

?>