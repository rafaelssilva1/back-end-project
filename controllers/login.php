<?php

    use ReallySimpleJWT\Token;
        
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        if(isset($_COOKIE["token"])) {
            require("models/movies.php");
            $model = new Movie();
            $userPayload = $model->checkAuthToken();
            $userComments = $model->getCommentsByUser($userPayload["user_id"]);
            require("views/user-area.php");
        } else {
            require("views/login.php");
        }
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        require("models/users.php");
        $model = new User();

        if(isset($_POST["usernameLogin"]) and isset($_POST["passwordLogin"]) ) {
            if (
                empty($_POST) or
                mb_strlen($_POST["usernameLogin"]) < 3 or
                mb_strlen($_POST["usernameLogin"]) > 32 or
                mb_strlen($_POST["passwordLogin"]) < 8 or
                mb_strlen($_POST["passwordLogin"]) > 1000
            ) {
                http_response_code(405);
                $_SESSION['message'] = "The username or password is incorrect. Please try again.";
                require("views/login.php");
                die();
            }

            $user = $model->login($_POST["usernameLogin"], $_POST["passwordLogin"]);
            
            if(empty($user)) {
                http_response_code(401);
                $_SESSION['message'] = "The username or password is incorrect. Please try again.";
                require("views/login.php");
            } else {
                $payload = [
                    'iat' => time(),
                    'exp' => time() + (60 * 60 * 24),
                    'user_id' => $user["user_id"],
                    'username' => $user["username"],
                    'is_admin' => $user["is_admin"]
                ];
                $secret = ENV["JWT_KEY"];
        
                $token = Token::customPayload($payload, $secret);
    
                setcookie("token", $token, time() + (60 * 60 * 24), "/");
    
                header("Location: /");
            }

        }

        if(isset($_POST["usernameRegister"]) and isset($_POST["passwordRegister"]) and isset($_POST["emailRegister"])) {
            if (
                empty($_POST) or
                mb_strlen($_POST["usernameRegister"]) < 3 or
                mb_strlen($_POST["usernameRegister"]) > 32 or
                mb_strlen($_POST["passwordRegister"]) < 8 or
                mb_strlen($_POST["passwordRegister"]) > 1000 or
                !filter_var($_POST["emailRegister"], FILTER_VALIDATE_EMAIL)
            ) {
                http_response_code(405);
                $_SESSION['message'] = "The username must have more than 3 characters and the password more than 8.";
                require("views/login.php");
                die();
            }

            $validateUser = $model->validateUser($_POST["usernameRegister"]);

            if(empty($validateUser)) {
                $createUser = $model->createUser($_POST["usernameRegister"], $_POST["emailRegister"], $_POST["passwordRegister"]);
                $login = $model->login($_POST["usernameRegister"], $_POST["passwordRegister"]);

                if(empty($login)) {
                    http_response_code(401);
                    $_SESSION['message'] = "An authentication error has occurred. Please try again or contact us info@".ENV["DB_HOST"]."";
                    require("views/login.php");
                    die();
                }
    
                $payload = [
                    'iat' => time(),
                    'exp' => time() + (60 * 60 * 24),
                    'user_id' => $login["user_id"],
                    'username' => $login["username"],
                    'is_admin' => $login["is_admin"]
                ];
                $secret = ENV["JWT_KEY"];
        
                $token = Token::customPayload($payload, $secret);
    
                setcookie("token", $token, time() + (60 * 60 * 24), "/");
    
                header("Location: /");
            } else {
                header("Location: /login/");
            }

        }
        
        if(isset($_POST["passwordUpdate"])) {
            $userPayload = $model->checkAuthToken();

            if (
                empty($_POST) or
                mb_strlen($_POST["passwordUpdate"]) < 8 or
                mb_strlen($_POST["passwordUpdate"]) > 1000
            ) {
                http_response_code(405);
                $_SESSION['message'] = "Password must have more than 8 characters. Please try again.";
                require("models/movies.php");
                $movieMethod = new Movie();
                $userComments = $movieMethod->getCommentsByUser($userPayload["user_id"]);
                require("views/user-area.php");
                die($_SESSION['message'] = "Password must have more than 8 characters. Please try again.");
            }

            $validateUser = $model->validateUser($userPayload["username"]);

            if(!empty($validateUser)) {
                $updateUser = $model->updateUser($userPayload["username"], $_POST["passwordUpdate"]);
                $login = $model->login($userPayload["username"], $_POST["passwordUpdate"]);

                if(empty($login)) {
                    http_response_code(401);
                    $_SESSION['message'] = "Password must have more than 8 characters. Please try again.";
                    require("views/user-area.php");
                    die();
                } else {
                    $payload = [
                        'iat' => time(),
                        'exp' => time() + (60 * 60 * 24),
                        'user_id' => $login["user_id"],
                        'username' => $login["username"],
                        'is_admin' => $login["is_admin"]
                    ];
                    $secret = ENV["JWT_KEY"];
            
                    $token = Token::customPayload($payload, $secret);
        
                    setcookie("token", $token, time() + (60 * 60 * 24), "/");
        
                    header("Location: /");
                }
            } else {
                header("Location: /login/");
            }

        }
    }
?>