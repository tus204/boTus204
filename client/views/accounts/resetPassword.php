<?php
    $email = isset($_GET['email']) ? urldecode($_GET['email']) : '';
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/login.css">
    <title>Đặt lại mật khẩu</title>
</head> -->

<body>
    <div class="wrapper">
        <div class="container">
            <form class="login-form" method="post" action="">
                <h2 class="form-heading">Đặt lại mật khẩu</h2>   
                <div class="form-control">
                    <input name="email" type="email" placeholder="" value="<?php echo $email; ?>" required>
                </div>             
                <div class="form-control">
                    <input name="newPassword" type="password" placeholder="Nhập mật khẩu mới" required>
                </div>
                <div class="form-control">
                    <input name="confirmNewPassword" type="password" placeholder="Xác nhận mật khẩu mới" required>
                </div>
                <button name="btn-reset-password" class="form-btn">Đặt lại mật khẩu</button>
            </form>
        </div>
    </div>
</body>

</html>