<?php

    use ReallySimpleJWT\Token;

    require("models/movies.php");
    $model = new Movie();
    require("models/users.php");
    $modelUser = new User();

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
                    $_SESSION["message"] = "Your file is too big.";
                }
            } else {
                $_SESSION["message"] = "There was an error uploading your file";
            }
        } else {
            $_SESSION["message"] = "You cannot upload files of this type.";
        }
    }
    
    if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
        $userPayload = $model->checkAuthToken();

        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }
        $genres = $model->getGenres();
        $getMovies = $model->getMovies();

        if(!empty($id)) {
            $movie = $model->getMovieById($id);
        }

        $users = $modelUser->getUsers();

        require("views/admin.php");
    }

    else if( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $userPayload = $model->checkAuthToken();
        $genresCount = $model->getGenresCount();
        
        if(!$userPayload["is_admin"]) {
            header("Location: /login/");
        }
        if(isset($_POST["id"]) and isset($_POST["title"]) and isset($_POST["overview"]) and isset($_POST["release_date"]) and isset($_POST["duration"]) and isset($_POST["genres_id"]) and isset($_POST["trailer_link"])) {
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
                $_SESSION['message'] = "You have entered invalid information. Please try again.";
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
                die();
            }
            
            $updateMovie = $model->editMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], validateFile($_FILES["backdrop_path"], "backdrop_path"), validateFile($_FILES["poster_path"], "poster_path"), $_POST["id"]);

            if(!$updateMovie) {
                $_SESSION['message'] = "An error has occurred. Please try again.";
                http_response_code(500);
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
            } else {
                $_SESSION['message'] = "Movie edited successfully.";
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
                $_SESSION['message'] = "You have entered invalid information. Please try again.";
                $getMovies = $model->getMovies();
                $users = $modelUser->getUsers();
                require("views/admin.php");
                die();
            }
            
            $createMovie = $model->createMovie($_POST["title"], $_POST["overview"], $_POST["release_date"], $_POST["duration"], $_POST["genres_id"], $_POST["trailer_link"], validateFile($_FILES["backdrop_path"], "backdrop_path"), validateFile($_FILES["poster_path"], "poster_path"));
            
            if(!$createMovie) {
                $_SESSION['message'] = "An error has occurred. Please try again.";
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