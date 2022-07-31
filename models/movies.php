<?php

    class Movie extends Base {
        public function getAll($offset) {
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

        public function getMovieById($id) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, release_date, duration, trailer_link,
                    CASE
                        WHEN ROUND(AVG(comments.rating), 1) IS NULL THEN 'N/A'
                        ELSE  ROUND(AVG(comments.rating), 1)
                    END as vote_avg
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id 
                WHERE id = ?
                LIMIT 12;
            ");
            
            $query->execute([
                $id
            ]);
            
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
                SELECT movie_id, user_id
                FROM watchlist
                WHERE movie_id = ? and user_id = ?
            ");
            
            $query->execute([
                $movie_id,
                $user_id
            ]);
            
            return $query->fetchAll();
        }

        public function deleteFromWatchlist($movie_id, $user_id) {
            $query = $this->db->prepare("
                DELETE FROM watchlist
                WHERE movie_id = ? and user_id = ?
            ");
            
            return $query->execute([
                $movie_id,
                $user_id
            ]);
            
        }

        public function getComments($id) {
            $query = $this->db->prepare("
                SELECT username, comment_text, created_at, rating
                FROM comments
                WHERE movie_id = ?
            ");
            
            $query->execute([
                $id
            ]);
            
            return $query->fetchAll();
        }

        public function getCommentsByUser($user) {
            $query = $this->db->prepare("
                SELECT movies.id, movies.title, comments.username, comments.comment_text, comments.created_at, comments.rating, movies.poster_path
                FROM comments
                INNER JOIN movies ON comments.movie_id = movies.id
                WHERE user_id = ?
            ");
            
            $query->execute([
                $user
            ]);
            
            return $query->fetchAll();
        }

        public function getCommentByUserAndMovie($user, $movie_id) {
            $query = $this->db->prepare("
                SELECT movies.id, movies.title, comments.username, comments.comment_text, comments.created_at, comments.rating, movies.poster_path
                FROM comments
                INNER JOIN movies ON comments.movie_id = movies.id
                WHERE user_id = ? AND comments.movie_id = ?
            ");
            
            $query->execute([
                $user,
                $movie_id
            ]);
            
            return $query->fetch();
        }

        public function editComment($comment_text, $rating, $user_id, $movie_id) {
            $query = $this->db->prepare("
                UPDATE comments
                SET comment_text = ?, rating = ?
                WHERE user_id = ? AND movie_id = ?
            ");
            
            return $query->execute([
                $comment_text,
                $rating,
                $user_id,
                $movie_id
            ]);
        }

        public function postComments($movie_id, $user_id, $username, $comment_text, $rating) {
            $query = $this->db->prepare("
                INSERT INTO comments
                    (movie_id, user_id, username, comment_text, rating)
                VALUES
                    (?, ?, ?, ?, ?);
            ");
            
            $query->execute([
                $movie_id,
                $user_id,
                $username,
                $comment_text,
                $rating
            ]);
            
        }

        public function createMovie($title, $overview, $release_date, $duration, $genres_id, $trailer_link, $backdrop_path, $poster_path) {
            $query = $this->db->prepare("
                INSERT INTO movies
                    (title, overview, release_date, duration, genres_id, trailer_link, backdrop_path, poster_path)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?);
            ");
            
            return $query->execute([
                $title,
                $overview,
                $release_date,
                $duration,
                $genres_id,
                $trailer_link,
                $backdrop_path,
                $poster_path
            ]);
            
        }
    }

?>