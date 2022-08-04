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

        public function getMovies() {
            $query = $this->db->prepare("
                SELECT id, title, poster_path, 
                    CASE
                        WHEN ROUND(AVG(comments.rating), 1) IS NULL THEN 'N/A'
                        ELSE  ROUND(AVG(comments.rating), 1)
                    END AS vote_avg,
                    COUNT(comments.rating) AS vote_count
                FROM movies
                LEFT JOIN comments ON movies.id = comments.movie_id
                GROUP BY id
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getMovieById($id) {
            $query = $this->db->prepare("
                SELECT id, title, overview, poster_path, backdrop_path, release_date, duration, trailer_link, genres_id,
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

        public function deleteMovie($movie_id) {
            $query = $this->db->prepare("
                DELETE FROM movies
                WHERE id = ?
            ");
            
            return $query->execute([
                $movie_id
            ]);
            
        }


        public function getGenres() {
            $query = $this->db->prepare("
                SELECT id, name
                FROM genres
            ");
            
            $query->execute();
            
            return $query->fetchAll();
        }

        public function getGenresCount() {
            $query = $this->db->prepare("
                SELECT COUNT(*)
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
                SELECT users.username, comment_text, created_at, rating
                FROM comments
                INNER JOIN users ON comments.user_id = users.user_id
                WHERE movie_id = ?
            ");
            
            $query->execute([
                $id
            ]);
            
            return $query->fetchAll();
        }

        public function getCommentsByUser($user) {
            $query = $this->db->prepare("
                SELECT movies.id, movies.title, users.username, comments.comment_text, comments.created_at, comments.rating, movies.poster_path
                FROM comments
                INNER JOIN movies ON comments.movie_id = movies.id
                INNER JOIN users ON comments.user_id = users.user_id
                WHERE comments.user_id = ?
            ");
            
            $query->execute([
                $user
            ]);
            
            return $query->fetchAll();
        }

        public function getCommentByUserAndMovie($user, $movie_id) {
            $query = $this->db->prepare("
                SELECT movies.id, movies.title, users.username, comments.comment_text, comments.created_at, comments.rating, movies.poster_path
                FROM comments
                INNER JOIN movies ON comments.movie_id = movies.id
                INNER JOIN users ON comments.user_id = users.user_id
                WHERE comments.user_id = ? AND comments.movie_id = ?
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

        public function postComments($movie_id, $user_id, $comment_text, $rating) {
            $query = $this->db->prepare("
                INSERT INTO comments
                    (movie_id, user_id, comment_text, rating)
                VALUES
                    (?, ?, ?, ?);
            ");
            
            $query->execute([
                $movie_id,
                $user_id,
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

        public function editMovie($title, $overview, $release_date, $duration, $genres_id, $trailer_link, $backdrop_path, $poster_path, $movie_id) {
            $query = $this->db->prepare("
                UPDATE movies
                SET title = ?, overview = ?, release_date = ?, duration = ?, genres_id = ?, trailer_link = ?, backdrop_path = ?, poster_path = ?
                WHERE id = ?
            ");
            
            return $query->execute([
                $title,
                $overview,
                $release_date,
                $duration,
                $genres_id,
                $trailer_link,
                $backdrop_path,
                $poster_path,
                $movie_id
            ]);
        }
    }

?>