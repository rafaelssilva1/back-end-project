<?php
    use ReallySimpleJWT\Token;

    class Base {
        public $db;
        public $user;

        public function __construct() {
            $this->db = new PDO(
                "mysql:host=" .ENV["DB_HOST"]. ";dbname=" .ENV["DB_NAME"]. ";charset=utf8mb4",
                ENV["DB_USER"],
                ENV["DB_PASSWORD"]
            );
    
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        public function getMoviesCount() {
            $query = $this->db->prepare("
                SELECT COUNT(*) as count
                FROM movies
            ");
            
            $query->execute();
            
            return $query->fetch();
        }

        public function getMoviesCountByGenre($id) {
            $query = $this->db->prepare("
                SELECT COUNT(*) as count
                FROM movies
                WHERE genres_id = ?
            ");
            
            $query->execute([
                $id
            ]);
            
            return $query->fetch();
        }

        public function checkAuthToken() {    
            if(isset($_COOKIE["token"])) {
                $isValid = Token::validate($_COOKIE["token"], ENV["JWT_KEY"]);
                if($isValid) {
                    return $userPayload = Token::getPayload($_COOKIE["token"], ENV["JWT_KEY"]);
                }
            }
        }
    }
?>