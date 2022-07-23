<?php

define("ENV", parse_ini_file(".env"));

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$resource = $parts[1] ;

$id = $parts[2] ?? "";

$controllers = ["movies", "search", "login", "admin"];

require_once("models/base.php");

if(empty($resource)) {
    require("controllers/movies.php");
} else {
    require("controllers/" .$resource. ".php");

}

?>