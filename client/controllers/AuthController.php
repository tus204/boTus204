<?php

namespace Controllers;

use Models\AuthModel;
use Views\Accounts\LoginView;
use Views\Accounts\RegisterView;

class AuthController extends AuthModel {
    function loginUser($email, $password) {

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['user_id'])) {
            // Người dùng đã đăng nhập, chuyển hướng đến index
            $this->redirectUser();
            return;
        }

        $error = new Validate();
        $errors =  $error->validateLogin($email, $password);
        if (!empty($errors)) {
            $loginView = new LoginView();
            $loginView->loginReder($errors);
            return;
        }

        $user = $this->getUserByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Login successfully
                $this->setSession($user);
                echo 'oke bro';
                $this->redirectUser();
            } else {
                $errors['password'] = "Mật khẩu không đúng";
            }
        } else {
            $errors['email'] = "Người dùng không tồn tại";
        }

        $loginView = new LoginView();
        $loginView->loginReder($errors);
        return;
    }

    function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-register'])) {
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
        $validate = new Validate();
        $errors = $validate->validateRegister($fullName, $email, $password);

        // hiển thị thông báo khi nhập chưa đủ hoặc sai
        if (array_filter($errors)) {
            $registerView = new RegisterView();
            $registerView->registerRender($errors);
            return;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Lưu dữ liệu vào db
        $result = $this->saveUser($fullName, $email, $hashedPassword);

        if ($result) {
            echo "Đăng ký thành công";
            // set cookie để lấy tài khoản, mật khẩu user dán vào login luôn cho tiện =))
            setcookie("regEmail", $email, time() + 600, "/");
            setcookie("regPassword", $password, time() + 600, "/");
            // chuyển hướng
            header("Location: /quizASM/?act=login&email=$email&password=$password");
        } else {
            echo "Đăng ký thất bại";
            // return;
        }
        } else {
            $registerView = new RegisterView();
            $registerView->registerRender();
        }
    }

    function logoutUser() {
        session_unset();
        session_destroy();
        header("Location: /quizASM/");
    }

    private function setSession($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['mobile'] = $user['mobile'];
        $_SESSION['gender'] = $user['gender'];
        $_SESSION['avatar'] = $user['image'] ? $user['image'] : "https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg";
    }

    private function redirectUser() {
        // Chuyển hướng
        if ($_SESSION['role'] == 'Admin') {
            header("Location: /quizASM/admin/");
        } elseif ($_SESSION['role'] == 'Client') {
            header("Location: /quizASM/");
        }
    }
}