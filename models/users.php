<?php

    class User extends Base {        
        public function getUsers() {
            $query = $this->db->prepare("
                SELECT username, email, password
                FROM users
            ");
            
            $query->execute([]);

            return $query->fetchAll();
        }

        public function getUser($id) {
            if(!empty($id)) {
                $query = $this->db->prepare("
                SELECT username, email, password
                FROM users
                WHERE user_id = ?
            ");
            
            $query->execute([
                $id
            ]);
        
            }

            return $query->fetch();
        }

        public function validateUser($username) {
            $query = $this->db->prepare("
                SELECT username
                FROM users
                WHERE username = ? 
            ");
            
            $query->execute([
                $username
            ]);
        
            return $query->fetch();
        }

        public function createUser($username, $email, $password) {
            $query = $this->db->prepare("
                INSERT INTO users
                (username, email, password)
            VALUES
                (?, ?, ?);
            ");
            
            $query->execute([
                $username,
                $email,
                password_hash($password, PASSWORD_DEFAULT)
            ]);

            return $this->db->lastInsertId();
        }

        public function updateUser($username, $password) {
            $query = $this->db->prepare("
                UPDATE users
                SET
                    password = ?
                WHERE username = ?
            ");

            return $query->execute([
                password_hash($password, PASSWORD_DEFAULT),
                $username
            ]);
            
        }

        public function deleteUser($id) {
            $query = $this->db->prepare("
                DELETE FROM users
                WHERE user_id = ?
            ");

            $query->execute([
                $id
            ]);
        }

        public function login($email, $password) {

            $query = $this->db->prepare("
                SELECT
                    user_id, username,
                    password, is_admin
                FROM users
                WHERE username = ?
            ");
            
            $query->execute([
                $email
            ]);
            
            $user = $query->fetch();
    
            if(
                !empty($user) &&
                password_verify($password, $user["password"])
            ) {
                return $user;
            }
    
            return false;
        }
    }

?>