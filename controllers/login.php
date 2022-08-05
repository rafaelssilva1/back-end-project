<?php

    use ReallySimpleJWT\Token;

    function generateToken($user) {
        $payload = [
            'iat' => time(),
            'exp' => time() + (60 * 60 * 2),
            'user_id' => $user["user_id"],
            'username' => $user["username"],
            'is_admin' => $user["is_admin"]
        ];
        $secret = ENV["JWT_KEY"];

        $token = Token::customPayload($payload, $secret);

        setcookie("token", $token, time() + (60 * 60 * 2), "/");
    
        header("Location: /");
    }
        
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        require("models/movies.php");
        $model = new Movie();

        $userPayload = $model->checkAuthToken();
        if(isset($userPayload)) {
            $userComments = $model->getCommentsByUser($userPayload["user_id"]);
            require("views/user-area.php");
        } else {
            require("views/login.php");
        }
    }

    else if($_SERVER["REQUEST_METHOD"] === "POST") {
        require("models/users.php");
        $model = new User();

        if(isset($_POST["usernameLogin"]) and isset($_POST["passwordLogin"]) ) {
            if (
                empty($_POST) or
                mb_strlen($_POST["usernameLogin"]) < 3 or
                mb_strlen($_POST["usernameLogin"]) > 32 or
                mb_strlen($_POST["passwordLogin"]) < 8 or
                mb_strlen($_POST["passwordLogin"]) > 124
            ) {
                http_response_code(400);
                $_SESSION['message'] = "The username or password is incorrect. Please try again.";
                require("views/login.php");
                die();
            }

            $user = $model->login($_POST["usernameLogin"], $_POST["passwordLogin"]);
            
            if(empty($user)) {
                http_response_code(400);
                $_SESSION['message'] = "The username or password is incorrect. Please try again.";
                require("views/login.php");
            } else {
                
                generateToken($user);
                
            }

        }

        if(isset($_POST["usernameRegister"]) and isset($_POST["passwordRegister"]) and isset($_POST["emailRegister"])) {
            if (
                empty($_POST) or
                mb_strlen($_POST["usernameRegister"]) < 3 or
                mb_strlen($_POST["usernameRegister"]) > 32 or
                mb_strlen($_POST["passwordRegister"]) < 8 or
                mb_strlen($_POST["passwordRegister"]) > 124 or
                !filter_var($_POST["emailRegister"], FILTER_VALIDATE_EMAIL)
            ) {
                http_response_code(400);
                $_SESSION['message'] = "The username must have more than 3 characters and the password more than 8.";
                require("views/login.php");
                die();
            }

            $validateUsername = $model->validateUsername($_POST["usernameRegister"]);
            $validateEmail = $model->validateEmail($_POST["emailRegister"]);

            if(empty($validateUsername) and empty($validateEmail)) {
                $createUser = $model->createUser($_POST["usernameRegister"], $_POST["emailRegister"], $_POST["passwordRegister"]);
                $login = $model->login($_POST["usernameRegister"], $_POST["passwordRegister"]);

                if(empty($login)) {
                    http_response_code(500);
                    $_SESSION['message'] = "An authentication error has occurred. Please try again or contact us info@".ENV["DB_HOST"]."";
                    require("views/login.php");
                    die();
                }
    
                generateToken($user);

            } else {
                http_response_code(400);
                $_SESSION['message'] = "The username or email already exists. Please try again.";
                require("views/login.php");
                die();
            }

        }
        
        if(isset($_POST["passwordUpdate"])) {
            $userPayload = $model->checkAuthToken();

            if(!isset($userPayload)) {
                http_response_code(400);
                header("Location: /login/");
            }

            if (
                empty($_POST) or
                mb_strlen($_POST["passwordUpdate"]) < 8 or
                mb_strlen($_POST["passwordUpdate"]) > 124
            ) {
                http_response_code(400);
                $_SESSION['message'] = "Password must have more than 8 characters. Please try again.";

                require("models/movies.php");
                $movieMethod = new Movie();
                
                $userComments = $movieMethod->getCommentsByUser($userPayload["user_id"]);
                require("views/user-area.php");
                die();
            }

            $updateUser = $model->updateUser($userPayload["username"], $_POST["passwordUpdate"]);
            $login = $model->login($userPayload["username"], $_POST["passwordUpdate"]);

            if(empty($login)) {
                http_response_code(403);
                $_SESSION['message'] = "Password must have more than 8 characters. Please try again.";
                require("views/user-area.php");
                die();
            } else {

                generateToken($user);

            }

        }
    }

    else {
        http_response_code(405);
    }
    
?>