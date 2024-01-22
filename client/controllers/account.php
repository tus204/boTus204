<?php
    session_start();
    // ket noi database
    $conn = pdo_get_connection();
    if (!$conn) {
        die("Kết nối đến CSDL thất bại: " . $conn->error);
    }
    // try {
    //     $conn = pdo_get_connection();
    //     echo "Kết nối đến CSDL thành công!";
    // } catch (PDOException $e) {
    //     echo "Lỗi kết nối đến CSDL: " . $e->getMessage();
    // }
    
    if (isset($_POST['btn-register'])) {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash mật khẩu
        // $password = $_POST['password']; 
        echo "Full Name: $fullName, Email: $email, Password: $password";

        // thêm thông tin người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
        echo "Câu lệnh SQL: $sql";
        
        if ($conn->query($sql)) {
            echo "Đăng ký thành công";
            header("Location: ../views/accounts/login.php"); // chuyển hướng sang trang login khi đăng kí thành công
        } else {
            $errorInfo = $conn->errorInfo();
            echo "Đăng ký thất bại !!!: " . $sql . "<br>" . $errorInfo[2];
        }
    }

    if (isset($_POST['btn-login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // kiểm tra đăng nhập
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                // Đăng nhập thành công, lưu thông tin người dùng vào session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['full_name'] = $row['full_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                
                // Chuyển hướng tùy theo quyền của người dùng
                if ($_SESSION['role'] == 'Admin') {
                    header("Location: /VietNamHistory/admin/");
                } elseif ($_SESSION['role'] == 'Client') {
                    header("Location: /VietNamHistory/client/");
                } 
                } else {
                    echo "Mật khẩu không đúng";
            } 
        } else {
            echo "Người dùng không tồn tại";
            }
    }

    if (isset($_POST['btn-forget-password'])) {
        $email = $_POST['email'];
        // kiểm tra và gửi email reset mật khẩu
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
    
        if ($result->rowCount() > 0) {
            // chuyển hướng đến trang reset password
            echo "Gửi email reset mật khẩu thành công. Vui lòng kiểm tra email để đặt lại mật khẩu.";
            // echo "<br><a href='../views/accounts/resetPassword.php'>Đặt lại mật khẩu</a>";
            header("Location: ../views/accounts/resetPassword.php?email=" . urlencode($email));
        } else {
            echo "Người dùng không tồn tại";
        }
    }

    if (isset($_POST['btn-reset-password'])) {
        $email = $_POST['email'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmNewPassword'];

        if ($newPassword === $confirmPassword) {            
            $hashePassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // cập nhật mật khẩu trong cơ sở dữ liệu
            $sql = "UPDATE users SET password='$hashePassword' WHERE email='$email'";
    
            if ($conn->query($sql)) {
                echo "Đặt lại mật khẩu thành công";
                // Chuyển hướng sang trang login khi đặt lại mật khẩu thành công
                header("Location: ../views/accounts/login.php");
            } else {
                echo "Đặt lại mật khẩu thất bại" . $sql . "<br>" . $conn->errorInfo();
            }
        } else {
            echo "Mật khẩu không khớp, vui lòng nhập lại !!!";
        }
    }

    // đóng kết nối
    // $conn = null;
?>