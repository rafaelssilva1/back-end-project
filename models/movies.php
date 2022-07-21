<?php

    class Movie extends Base {
        public function getAll() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path
                FROM movies
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getMovieById($id) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path
                FROM movies
                WHERE id = ?
            ");
            
            $query->execute([
                $id
            ]);
            
            return $query->fetch();
        }
    }

?>