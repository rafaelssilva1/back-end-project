<?php

class Movie extends Base {
    public function searchMovie($input) {
        $query = $this->db->prepare("
            SELECT id, title, overview, poster_path,
                CASE
                    WHEN AVG(comments.rating) IS NULL THEN 'N/A'
                    ELSE ROUND(AVG(COALESCE(comments.rating, 0)), 1)
                END AS vote_avg
            FROM movies
            LEFT JOIN comments ON movies.id = comments.movie_id
            WHERE id > ?
            GROUP BY id
            LIMIT 12;
        ");
        
        $query->execute([
            $offset
        ]);
        
        return $query->fetchAll();
    }
}

?>