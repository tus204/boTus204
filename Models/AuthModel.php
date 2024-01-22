<?php

namespace Models;

use Core\Database;
use \PDO;
use \PDOException;

class AuthModel extends Database {
    protected function getUserByEmail($email) {
        // kiểm tra đăng nhập
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->conn->query($sql);
    
        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }

    protected function saveUser($fullName, $email, $password) {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        try {
            $this->pdo_execute($sql, $fullName, $email, $password);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}