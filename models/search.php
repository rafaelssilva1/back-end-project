<?php

    class Search extends Base {

        public function searchMovies($input) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path,
                    CASE
                        WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                WHERE title LIKE CONCAT('%', ?, '%') OR overview LIKE CONCAT('%', ?, '%')
                GROUP BY id;
            ");
            
            $query->execute([
                $input,
                $input
            ]);
            
            return $query->fetchAll();
        }

        public function searchByGenre($genre) {
            $query = $this->db->prepare("
                SELECT movies.id, movies.title, movies.overview, movies.poster_path,
                    CASE
                        WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                INNER JOIN genres ON movies.genres_id = genres.id
                WHERE movies.genres_id = ?
                GROUP BY id
                LIMIT 12;
            ");
            
            $query->execute([
                $genre
            ]);
            
            return $query->fetchAll();
        }
    }

?>