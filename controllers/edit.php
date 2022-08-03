<?php

    use ReallySimpleJWT\Token;

    require("models/movies.php");
    $model = new Movie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();
        if(!empty($id)) {
            $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
            require("views/edit.php");
        } else {
            header("Location: /login/");
        }
    }

    if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();

        if(!isset($userPayload)) {
            http_response_code(403);
            header("Location: /login/");
        }

        $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
        $editComment = $model->editComment($_POST["comment_text"], $_POST["rating"], $userPayload["user_id"], $id);
        header("Location: /movies/".$id);
    }

?>