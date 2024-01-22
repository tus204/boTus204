<?php

namespace Controllers;

class Validate {
    function validateLogin($email, $password) {
        $errors = [];

        // Validate email
        if (empty($email)) {
            $errors['email'] = "Email không được bỏ trống";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        }
        // Validate password
        if (empty($password)) {
            $errors['password'] = "Mật khẩu không được bỏ trống";
        }

        return $errors;
    }

    function validateRegister($fullName, $email, $password) {
        $errors = [];

        // Validate full name
        if (empty($fullName)) {
            $errors['fullName'] = "Họ và tên không được bỏ trống";
        }

        // Validate email
        if (empty($email)) {
            $errors['email'] = "Email không được bỏ trống";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        }

        // Validate password
        if (empty($password)) {
            $errors['password'] = "Mật khẩu không được bỏ trống";
        }

        return $errors;
    }
}