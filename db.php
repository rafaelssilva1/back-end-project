<?php
    /*
    $db = new PDO("mysql:host=localhost;dbname=brutally_honest;charset=utf8mb4", "root", "");

    $raw_data = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=fc6299fc3f6fe2d5a1a9bfa2ef65cd7e&language=en-US");
    $users = json_decode($raw_data, true);

    foreach ($users["genres"] as $user) {
        $query = $db->prepare("
            INSERT INTO genres (name)
            VALUES (?)
        ");
        $result = $query->execute([
            $user["name"]
        ]);

        if($result) {
            echo "<p>Inseriu utilizador ".$user["id"]."</p>";
        } else {
            echo "<p>Não inseriu utilizador ".$user["id"]."</p>";
        }
    }
    */
?>