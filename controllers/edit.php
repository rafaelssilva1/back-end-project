<?php

    use ReallySimpleJWT\Token;

    require("models/movies.php");
    $model = new Movie();

    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(!isset($userPayload)) {
            http_response_code(401);
            header("Location: /login/");
        }

        if(!empty($id)) {
            $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
            require("views/edit.php");
        }
    }

    else if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();

        $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);

        if(!$userComment) {
            $message = "An error has occurred. Please try again.";
            http_response_code(500);
            require("views/edit.php");
        } else {
            if (
                empty($_POST) or
                mb_strlen($_POST["comment_text"]) < 1 or
                mb_strlen($_POST["comment_text"]) > 65535 or
                intval($_POST["rating"]) < 1 or
                intval($_POST["rating"]) > 10
            ) {
                http_response_code(400);
                $message = "Comments must be longer than one character.";
                require("views/edit.php");
            }

            $editComment = $model->editComment($_POST["comment_text"], $_POST["rating"], $userPayload["user_id"], $id);

            if(!$editComment) {
                $message = "An error has occurred. Please try again.";
                $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
                http_response_code(500);
                require("views/edit.php");
            } else {
                $message = "Review edited successfully.";
                $userComment = $model->getCommentByUserAndMovie($userPayload["user_id"], $id);
                http_response_code(202);
                require("views/edit.php");
            }
        }

    }

    else {
        http_response_code(405);
    }

?>