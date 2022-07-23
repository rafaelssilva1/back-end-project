<?php

    class Home extends Base {
        public function getRandomMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, backdrop_path
                FROM movies
                ORDER BY RAND()
                LIMIT 1;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getPopularMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, COUNT(votes.movie_id) as votes_count,
                    CASE
                        WHEN AVG(votes.value) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(votes.value, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                GROUP BY id
                ORDER BY votes_count DESC
                LIMIT 12;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getTopRatedMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path,
                    CASE
                        WHEN AVG(votes.value) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(votes.value, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                GROUP BY id
                ORDER BY AVG(COALESCE(votes.value, 0)) DESC
                LIMIT 12;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getUpcomingMovies() {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, COUNT(votes.movie_id) as votes_count,
                    CASE
                        WHEN AVG(votes.value) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(votes.value, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                WHERE DATE(movies.release_date) > DATE(NOW())
                GROUP BY id
                LIMIT 12;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }
    }

?>