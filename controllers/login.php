<?php

    use ReallySimpleJWT\Token;
    
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        require("views/login.php");
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        require("models/users.php");
        $model = new User();

        if(isset($_POST["username"]) and isset($_POST["password"])) {
            if (
                empty($_POST) or
                mb_strlen($_POST["username"]) < 3 or
                mb_strlen($_POST["username"]) > 32 or
                mb_strlen($_POST["password"]) < 8 or
                mb_strlen($_POST["password"]) > 1000
            ) {
                http_response_code(405);
                echo '{"Message":"Method not allowed"}';
            }

            $user = $model->login($_POST["username"], $_POST["password"]);
            
            if(empty($user)) {
                http_response_code(401);
                die('{"message":"Authentication failed"}');
            }

            $payload = [
                'iat' => time(),
                'exp' => time() + (60 * 60 * 24 * 90),
                'user_id' => $user["user_id"],
                'username' => $user["username"],
                'is_admin' => $user["is_admin"]
            ];
            $secret = ENV["JWT_KEY"];
    
            $token = Token::customPayload($payload, $secret);

            setcookie("token", $token, time() + (60 * 60 * 24 * 90), "/");

            header("Location: /");
        }
        
    }
?>