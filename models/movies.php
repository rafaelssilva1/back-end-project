<?php

    class Movie extends Base {
        public function getAll() {
            $query = $this->db->prepare("
                SELECT id, title, overview, backdrop_path, poster_path
                FROM movies
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }
    }

?>