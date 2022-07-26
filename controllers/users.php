<?php

    require("models/users.php");
    $model = new User();

    if($_SERVER["REQUEST_METHOD"] === "GET") {
        if(!empty($id)) {
            $data = $model->getUser($id);
    
            if(empty($data)) {
                http_response_code(404);
                echo '{"Message": "Not found"}';
                exit;
            }
        } else {
            $data = $model->getUsers();
        }
        echo json_encode($data);
    }

    else if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        if(
            empty($data) or
            mb_strlen($data["username"]) < 3 or
            mb_strlen($data["username"]) > 40 or
            mb_strlen($data["password"]) < 9 or
            mb_strlen($data["password"]) > 100 or
            !filter_var($data["email"], FILTER_VALIDATE_EMAIL)
        ) {
            http_response_code(400);
            echo '{"Message":"Invalid information"}';
            exit;
        }

        $createUser = $model->createUser($data["username"], $data["email"], $data["password"]);

        unset($data["password"]);
        echo json_encode($data);

    }

    else if( $_SERVER["REQUEST_METHOD"] === "PUT" ) {
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        if(
            empty($data) or
            mb_strlen($data["username"]) < 3 or
            mb_strlen($data["username"]) > 40 or
            mb_strlen($data["password"]) < 9 or
            mb_strlen($data["password"]) > 100 or
            !filter_var($data["email"], FILTER_VALIDATE_EMAIL)
        ) {
            http_response_code(400);
            echo '{"Message":"Invalid information"}';
            exit;
        }

        if(empty($model->getUser($id))) {
            http_response_code(404);
            echo '{"Message": "Not found"}';
            exit;
        }

        $updateUser = $model->updateUser($data["username"], $data["email"], $data["password"], $id);

        if($updateUser) {
            http_response_code(202);
            unset($data["password"]);
            echo json_encode($data);
        } else {
            http_response_code(500);
            echo '{"Message":"Internal error"}';
        }
    }

    else if( $_SERVER["REQUEST_METHOD"] === "DELETE" ) {
        if(empty($id)) {
            http_response_code(400);
            echo '{"Message": "Invalid information"}';
            exit;
        }
    
        if(empty($model->getUser($id))) {
            http_response_code(404);
            echo '{"Message": "Not found"}';
            exit;
        }
    
        $deleteUser = $model->deleteUser($id);
    
        if(!$deleteUser) {
            http_response_code(202);
            echo '{"Message": "User deleted"}';
        } else {
            http_response_code(500);
            echo '{"Message":"Internal error"}';
        }
    }

    else {
        http_response_code(405);
        echo '{"Message":"Method not allowed"}';
    }
?>