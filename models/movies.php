<?php

    class Movie extends Base {
        public function getAll() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, ROUND(AVG(votes.value), 1) as vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                UNION
                SELECT id, title, overview, poster_path, 
                    CASE
                        WHEN votes.value IS NULL THEN 'N/A'
                    END as vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                WHERE votes.value IS NULL;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getMovieById($id) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, release_date, duration, trailer_link,
                    CASE
                        WHEN ROUND(AVG(votes.value), 1) IS NULL THEN 'N/A'
                        ELSE  ROUND(AVG(votes.value), 1)
                    END as vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id 
                WHERE id = ?;
            ");
            
            $query->execute([
                $id
            ]);
            
            return $query->fetch();
        }
    }

?>