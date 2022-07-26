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

        public function updateUser($username, $email, $password, $id) {
            $query = $this->db->prepare("
                UPDATE users
                SET
                    username = ?,
                    email = ?,
                    password = ?
                WHERE user_id = ?
            ");

            return $query->execute([
                $username,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $id
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
    }

?>