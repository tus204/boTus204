<?php
// Kiểm tra trường bắt buộc
function is_required($value) {
    return !empty($value);
}

// Kiểm tra định dạng email
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Kiểm tra độ dài của chuỗi
function is_valid_length($value, $min_length, $max_length) {
    $length = mb_strlen($value, 'UTF-8'); // Sử dụng mb_strlen để xử lý UTF-8 đúng cách
    return ($length >= $min_length && $length <= $max_length);
}

// Các hàm kiểm tra khác...

?>
