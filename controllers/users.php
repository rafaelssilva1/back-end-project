<?php
    require("models/users.php");
    $model = new User();

    if( $_SERVER["REQUEST_METHOD"] === "PUT" ) {
        $userPayload = $model->checkAuthToken();

        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        $updatePrivileges = $model->updatePrivileges($data["user_id"]);

        if(!$updatePrivileges) {
            http_response_code(202);
        } else {
            http_response_code(500);
        }
    } 
    
    else if( $_SERVER["REQUEST_METHOD"] === "DELETE" ) {
        $userPayload = $model->checkAuthToken();
        
        $body = file_get_contents("php://input");
        $data = json_decode($body, true);

        if(isset($data["user_id"])) {
            $deleteUser = $model->deleteUser($data["user_id"]);

            if(!$deleteUser) {
                http_response_code(202);
            } else {
                http_response_code(500);
            }
            
        } else if(isset($data["ownAccount"])) {
            $deleteUser = $model->deleteUser($userPayload["user_id"]);

            if(!$deleteUser) {
                http_response_code(202);
            } else {
                http_response_code(500);
            }
        }

        
    }

    else {
        http_response_code(405);
    }
?>