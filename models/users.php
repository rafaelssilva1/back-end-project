<?php

    class User extends Base {        
        public function getUsers() {
            $query = $this->db->prepare("
                SELECT user_id, username, email, password, is_admin
                FROM users
            ");
            
            $query->execute();

            return $query->fetchAll();
        }

        public function getUser($id) {
            $query = $this->db->prepare("
                SELECT user_id, username, email
                FROM users
                WHERE user_id = ?
            ");
            
            $query->execute([
                $id
            ]);

            return $query->fetch();
        }

        public function editUser($username, $email, $id) {
            $query = $this->db->prepare("
                UPDATE users
                SET
                    username = ?, email  = ?
                WHERE user_id = ?
            ");
            
            $query->execute([
                $username,
                $email,
                $id
            ]);

            return $query->fetch();
        }

        public function validateUsername($username) {
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

        public function validateEmail($email) {
            $query = $this->db->prepare("
                SELECT email
                FROM users
                WHERE email = ? 
            ");
            
            $query->execute([
                $email
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

        public function updateUser($user_id, $password) {
            $query = $this->db->prepare("
                UPDATE users
                SET
                    password = ?
                WHERE user_id = ?
            ");

            return $query->execute([
                password_hash($password, PASSWORD_DEFAULT),
                $user_id
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

        public function updatePrivileges($user_id) {
            $query = $this->db->prepare("
                UPDATE users
                SET
                    is_admin = NOT is_admin
                WHERE user_id = ?
            ");

            return $query->execute([
                $user_id
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