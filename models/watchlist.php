<?php

    class Watchlist extends Base {
        public function getAllWatchlist() {
            $query = $this->db->prepare("
                SELECT movies.id, movies.title, movies.overview, movies.poster_path,
                    CASE
                        WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                INNER JOIN watchlist on movies.id = watchlist.movie_id
                GROUP BY id;
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }
    }

?>