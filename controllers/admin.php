<?php

    use ReallySimpleJWT\Token;

    require("models/movies.php");
    $model = new Movie();
    require("models/users.php");
    $modelUser = new User();

    $array = ["movies", "users"];

    function validateFile($file, $folder) {
        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileError = $file["error"];
        $fileType = $file["type"];

        $fileExt = explode(".", $fileName);
        $fileExtension = strtolower(end($fileExt));

        $allowed = ["jpg", "jpeg", "png"];

        if(in_array($fileExtension, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 1000000) {
                    $fileNewName = uniqid("", true).".".$fileExtension;
                    $fileDestination = "uploads/".$folder."/".$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    return $fileNewName;
                } else {
                    $message = "Your file is too big.";
                }
            } else {
                $message = "There was an error uploading your file";
            }
        } else {
            $message = "You cannot upload files of this type.";
        }
    }
    
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }

        $genres = $model->getGenres();

        if(!empty($id2) and $id == "movies") {
            $movie = $model->getMovieById($id2);
            $users = $modelUser->getUsers();

            require("views/editmovies.php");

            exit();
        }

        if(!empty($id2) and $id == "users") {
            $user = $modelUser->getUser($id2);

            require("views/editusers.php");

            exit();
        }

        $getMovies = $model->getMovies();
        $users = $modelUser->getUsers();
        
        require("views/admin.php");
    }

    else if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();
        $genresCount = $model->getGenresCount();
        
        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }
        if(isset($_POST["type"]) and $_POST["type"] == "movies" and isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["overview"]) and isset($_POST["release_date"]) and isset($_POST["duration"]) and isset($_POST["genres_id"]) and isset($_POST["trailer_link"])) {
            $date = explode('-', $_POST["release_date"]);
            if (
                empty($_POST) or
                mb_strlen($_POST["title"]) < 0 or
                mb_strlen($_POST["title"]) > 64 or
                mb_strlen($_POST["overview"]) < 0 or
                mb_strlen($_POST["overview"]) > 65535 or
                !checkdate($date[1], $date[2], $date[0]) or
                intval($_POST["duration"]) < 1 or
                intval($_POST["duration"]) > 65535 or
                intval($_POST["genres_id"]) < 1 or
                intval($_POST["genres_id"]) > $genresCount or
                mb_strlen($_POST["trailer_link"]) != 11
            ) {
                http_response_code(400);
                $message = "You have entered invalid information. Please try again.";
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
                die();
            }
            
            $updateMovie = $model->editMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], validateFile($_FILES["backdrop_path"], "backdrop_path"), validateFile($_FILES["poster_path"], "poster_path"), $_POST["id"]);

            if(!$updateMovie) {
                $message = "An error has occurred. Please try again.";
                http_response_code(500);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            } else {
                $message = "Movie edited successfully.";
                http_response_code(202);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            }

        } else if (isset($_POST["type"]) and $_POST["type"] == "users" and isset($_POST["username"]) and isset($_POST["email"])) {
            if (
                empty($_POST) or
                mb_strlen($_POST["username"]) < 3 or
                mb_strlen($_POST["username"]) > 32 or
                !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
            ) {
                http_response_code(400);
                $message = "You have entered invalid information. Please try again.";
                require("views/editusers.php");
                die();
            }

            $editUser = $modelUser->editUser($_POST["username"], $_POST["email"], $_POST["id"]);

            if($editUser) {
                $message = "An error has occurred. Please try again.";
                http_response_code(500);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            } else {
                $message = "User edited successfully.";
                http_response_code(202);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            }   

        } else {
            if (
                empty($_POST)
            ) {
                http_response_code(400);
                $message = "You have entered invalid information. Please try again.";
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
                die();
            }
            
            $createMovie = $model->createMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], validateFile($_FILES["backdrop_path"], "backdrop_path"), validateFile($_FILES["poster_path"], "poster_path"));
            
            if(!$createMovie) {
                $message = "An error has occurred. Please try again.";
                http_response_code(500);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            } else {
                header("Location: /admin/?success");
            }
        }
    }

    else {
        http_response_code(405);
    }

?>