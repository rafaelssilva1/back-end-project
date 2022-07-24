<?php

define("ENV", parse_ini_file(".env"));

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$resource = $parts[1] ;

$id = $parts[2] ?? "";

$controllers = ["movies", "movie-night-ideas", "search", "login", "admin"];

require_once("models/base.php");

if(empty($resource)) {
    require("controllers/home.php");
} else if(!in_array($resource, $controllers)) {
    require("views/404.php");
} else {
    require("controllers/" .$resource. ".php");

}

?>