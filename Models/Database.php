<?php

namespace Models;

use \PDO;
use \PDOException;

class Database {
    private $dburl = "mysql:host=localhost;dbname=vietnam_history;charset=utf8";
    private $username = 'root';
    private $password = '';
    private $conn;

    function __construct()
    {
        $this->pdo_get_connection();
    }

    // Kết nối đến db
    function pdo_get_connection()
    {
        try {
            $this->conn = new PDO($this->dburl, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connection successfully';
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }   
    }


    /**
     * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_execute($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }

    function pdo_execute_last_result($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }

    /**
     * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @return array mảng các bản ghi
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_query($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }
    /**
     * Thực thi câu lệnh sql truy vấn một bản ghi
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @return array mảng chứa bản ghi
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_query_one($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }
    /**
     * Thực thi câu lệnh sql truy vấn một giá trị
     * @param string $sql câu lệnh sql
     * @param array $args mảng giá trị cung cấp cho các tham số của $sql
     * @return giá trị
     * @throws PDOException lỗi thực thi câu lệnh
     */
    function pdo_query_value($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return array_values($row)[0];
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($this->conn);
        }
    }
}


// /**
//  * Mở kết nối đến CSDL sử dụng PDO
//  */
// function pdo_get_connection()
// {
//     $dburl = "mysql:host=localhost;dbname=vietnam_history;charset=utf8";
//     $username = 'root';
//     $password = '';

//     $conn = new PDO($dburl, $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $conn;
// }
// /**
//  * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
//  * @param string $sql câu lệnh sql
//  * @param array $args mảng giá trị cung cấp cho các tham số của $sql
//  * @throws PDOException lỗi thực thi câu lệnh
//  */
// function pdo_execute($sql)
// {
//     $sql_args = array_slice(func_get_args(), 1);
//     try {
//         $conn = pdo_get_connection();
//         $stmt = $conn->prepare($sql);
//         $stmt->execute($sql_args);
//     } catch (PDOException $e) {
//         throw $e;
//     } finally {
//         unset($conn);
//     }
// }
// function pdo_execute_last_result($sql)
// {
//     $sql_args = array_slice(func_get_args(), 1);
//     try {
//         $conn = pdo_get_connection();
//         $stmt = $conn->prepare($sql);
//         $stmt->execute($sql_args);
//         return $conn->lastInsertId();
//     } catch (PDOException $e) {
//         throw $e;
//     } finally {
//         unset($conn);
//     }
// }
// /**
//  * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
//  * @param string $sql câu lệnh sql
//  * @param array $args mảng giá trị cung cấp cho các tham số của $sql
//  * @return array mảng các bản ghi
//  * @throws PDOException lỗi thực thi câu lệnh
//  */
// function pdo_query($sql)
// {
//     $sql_args = array_slice(func_get_args(), 1);
//     try {
//         $conn = pdo_get_connection();
//         $stmt = $conn->prepare($sql);
//         $stmt->execute($sql_args);
//         $rows = $stmt->fetchAll();
//         return $rows;
//     } catch (PDOException $e) {
//         throw $e;
//     } finally {
//         unset($conn);
//     }
// }
// /**
//  * Thực thi câu lệnh sql truy vấn một bản ghi
//  * @param string $sql câu lệnh sql
//  * @param array $args mảng giá trị cung cấp cho các tham số của $sql
//  * @return array mảng chứa bản ghi
//  * @throws PDOException lỗi thực thi câu lệnh
//  */
// function pdo_query_one($sql)
// {
//     $sql_args = array_slice(func_get_args(), 1);
//     try {
//         $conn = pdo_get_connection();
//         $stmt = $conn->prepare($sql);
//         $stmt->execute($sql_args);
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
//         return $row;
//     } catch (PDOException $e) {
//         throw $e;
//     } finally {
//         unset($conn);
//     }
// }
// /**
//  * Thực thi câu lệnh sql truy vấn một giá trị
//  * @param string $sql câu lệnh sql
//  * @param array $args mảng giá trị cung cấp cho các tham số của $sql
//  * @return giá trị
//  * @throws PDOException lỗi thực thi câu lệnh
//  */
// function pdo_query_value($sql)
// {
//     $sql_args = array_slice(func_get_args(), 1);
//     try {
//         $conn = pdo_get_connection();
//         $stmt = $conn->prepare($sql);
//         $stmt->execute($sql_args);
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
//         return array_values($row)[0];
//     } catch (PDOException $e) {
//         throw $e;
//     } finally {
//         unset($conn);
//     }
// }
