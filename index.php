<?php

require("vendor/autoload.php");

define("ENV", parse_ini_file(".env"));

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$resource = $parts[1] ;

$id = $parts[2] ?? "";

$id2 = $parts[3] ?? "";

$controllers = ["movies", "movie-night-ideas", "watchlist", "search", "login", "edit", "admin", "users"];

require_once("models/base.php");

if(empty($resource)) {
    require("controllers/home.php");
} else if(isset($_GET["page"]) and !isset($_GET["genres"]) and !isset($_GET["filter"])) {
    require("controllers/movies.php");
} else if((!in_array($resource, $controllers) and !isset($_GET["page"])) or $resource == "users") {
    http_response_code(404);
    require("views/404.php");
} else {
    require("controllers/" .$resource. ".php");
}

?>