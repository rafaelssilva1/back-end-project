<?php

    class Search extends Base {

        public function searchMovies($input) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path,
                    CASE
                        WHEN AVG(votes.value) IS NULL THEN 'N/A'
                        ELSE ROUND(AVG(COALESCE(votes.value, 0)), 1)
                    END AS vote_avg
                FROM movies
                LEFT JOIN votes ON movies.id = votes.movie_id
                WHERE title LIKE CONCAT('%', ?, '%') OR overview LIKE CONCAT('%', ?, '%')
                GROUP BY id;
            ");
            
            $query->execute([
                $input,
                $input
            ]);
            
            return $query->fetchAll();
        }
    }

?>