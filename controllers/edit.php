<?php

    use ReallySimpleJWT\Token;

    require("models/movies.php");
    $model = new Movie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();
        $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
        require("views/edit.php");
    }

    if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();
        $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
        $editComment = $model->editComment($_POST["comment_text"], $_POST["rating"], $userPayload["user_id"], $id);
        header("Location: /movies/".$id);
    }

?>