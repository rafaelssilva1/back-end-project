<?php

    class Movie extends Base {
        public function getAll($offset) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path,
                    CASE
                        WHEN AVG(votes.value) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(votes.value, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                WHERE id > ?
                GROUP BY id
                LIMIT 12;
            ");
            
            $query->execute([
                $offset
            ]);
            
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
                WHERE id = ?
                LIMIT 12;
            ");
            
            $query->execute([
                $id
            ]);
            
            return $query->fetch();
        }

        public function getMoviesCount() {
            $query = $this->db->prepare("
                SELECT COUNT(*) as count
                FROM movies
            ");
            
            $query->execute();
            
            return $query->fetch();
        }

        public function getGenres() {
            $query = $this->db->prepare("
                SELECT id, name
                FROM genres
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function postToWatchlist($movie_id, $user_id) {
            $query = $this->db->prepare("
                INSERT INTO watchlist
                    (movie_id , user_id)
                VALUES
                    (?, ?);
            ");
            
            $query->execute([
                $movie_id,
                $user_id
            ]);
            
        }

        public function searchWatchlist($movie_id, $user_id) {
            $query = $this->db->prepare("
                SELECT movie_id , user_id
                FROM watchlist
                WHERE movie_id = ? and user_id = ?
            ");
            
            $query->execute([
                $movie_id,
                $user_id
            ]);
            
            return $query->fetchAll();
        }
    }

?>