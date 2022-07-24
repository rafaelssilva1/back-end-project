<?php
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
    }
?>