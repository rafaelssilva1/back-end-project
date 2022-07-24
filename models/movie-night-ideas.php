<?php

class RandomMovie extends Base {
    public function getRandomMovie() {
        $query = $this->db->prepare("
            SELECT id, title, overview, poster_path
            FROM movies
            ORDER BY RAND()
            LIMIT 1;
        ");
        
        $query->execute();
        
        return $query->fetch();
    }
}

?>