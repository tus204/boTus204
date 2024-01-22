<?php

namespace Models;

use Core\Database;

class CategoryModel extends Database {

    public function insertCategory($categoryName) {
        $sql = "INSERT INTO `categories`(`category_name`) VALUES ('$categoryName')";
        $this->pdo_execute($sql);
    }

    public function loadAllCategories() {
        $sql = "SELECT * FROM categories ORDER BY category_id";
        return $this->pdo_query($sql);
    }

    public function deleteCategory($categoryId) {
        $sql = "DELETE FROM categories WHERE category_id = $categoryId";
        $this->pdo_execute($sql);
    }

    public function loadOneCategory($categoryId) {
        $sql = "SELECT * FROM categories WHERE category_id = $categoryId";
        return $this->pdo_query_one($sql);
    }

    public function updateCategory($categoryId, $categoryName) {
        $sql = "UPDATE categories SET category_name = '$categoryName' WHERE category_id = $categoryId";
        $this->pdo_execute($sql);
    }
}
