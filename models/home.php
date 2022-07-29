<?php

    class Home extends Base {
        public function getRandomMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, backdrop_path
                FROM movies
                ORDER BY RAND()
                LIMIT 5;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getPopularMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, COUNT(comments.movie_id) as votes_count,
                    CASE
                        WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                GROUP BY id
                ORDER BY votes_count DESC
                LIMIT 8;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getTopRatedMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path,
                    CASE
                        WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                GROUP BY id
                ORDER BY AVG(COALESCE(comments.rating, 0)) DESC
                LIMIT 8;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getUpcomingMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, COUNT(comments.movie_id) as votes_count,
                    CASE
                        WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                WHERE DATE(movies.release_date) > DATE(NOW())
                GROUP BY id
                LIMIT 8;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }
    }

?>