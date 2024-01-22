<?php

namespace Models;

use \PDOException;
use \PDO;
use Core\Database;

class UserModel extends Database {
    // update user
    function updateUser($user_id, $full_name, $email, $mobile, $role, $gender, $image)
    {
        try {
            // lấy thông từ ngưuời dùng từ id
            $user = $this->getUserById($user_id);

            // Kiểm tra xem có ảnh mới được tải lên không và cập nhật đường dẫn ảnh
            $image_path = empty($image["name"]) ? $user['image'] : $this->updateImage($image, $user['image']);

            // Cập nhật người dùng
            $sql_update = "UPDATE `users` SET `full_name`=?, `email`=?, `mobile`=?, `role`=?, `gender`=?, `image`=? WHERE `user_id`=?";
            $this->pdo_execute($sql_update, $full_name, $email, $mobile, $role, $gender, $image_path, $user_id);
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
        } finally {
            unset($this->conn);
        }
    }

    // Hàm update Profile
    function updateProfile($user_id, $full_name, $image, $email, $mobile, $gender) {
        try {
            // lấy thông từ ngưuời dùng từ id
            $user = $this->getUserById($user_id);

            // Kiểm tra xem có ảnh mới được tải lên không và cập nhật đường dẫn ảnh
            $image_path = empty($image["name"]) ? $user['image'] : $this->updateImage($image, $user['image']);

            // Cập nhật người dùng
            $sql_update = "UPDATE `users` SET `full_name`=?, `image`=?, `email`=?, `mobile`=?, `gender`=? WHERE `user_id`=?";
            $this->pdo_execute($sql_update, $full_name, $image_path, $email, $mobile, $gender, $user_id);
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
        }
    }
    
    // delete user
    function delUser($user_id)
    {
        $sql = "DELETE FROM `users` WHERE `user_id`=?";
        $this->pdo_execute($sql, $user_id);
    }
    
    // lay du lieu nguoi dung
    function getAllUsers() {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }

    function getUserById($user_id) {
        // Lấy thông tin người dùng từ database để hiển thị trong biểu mẫu cập nhật
        try {
            $sql = "SELECT * FROM users WHERE user_id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
        }            
    }

    // Hàm upload ảnh 
    function updateImage($newImage, $oldImagePath)
    {
        $target_dir = "../upload/";

        // Kiểm tra xem có ảnh mới được tải lên không
        if (!empty($newImage["name"])) {
            // Tạo đường dẫn mới cho ảnh
            $newImagePath = $target_dir . basename($newImage["name"]);

            // Di chuyển ảnh mới vào thư mục upload
            move_uploaded_file($newImage["tmp_name"], $newImagePath);

            return $newImagePath;
        } else {
            // Nếu không có ảnh mới, giữ nguyên đường dẫn ảnh cũ
            return $oldImagePath;
        }
    }


}

        
?>