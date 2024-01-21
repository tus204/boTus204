<!-- <!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../css/base.css">
     <link rel="stylesheet" href="../../css/login.css">
     <title>Đăng ký</title>
</head> -->
<body>
     <div class="wrapper">
          <div class="container">
               <form class="login-form" action="" method="POST">
                    <h2 class="form-heading">Đăng ký tài khoản</h2>
                    <p class="form-desc" >Bạn không có tài khoản ?
                         <a class="text-link" href="?act=login">Đăng nhập</a>
                         
                    </p>   

                    <div class="form-control">
                         <label>Họ và tên</label>
                         <input name="fullName" type="text" placeholder="Nhập họ tên của bạn" >
                    </div>

                    <div class="form-control">
                         <label>Email</label>
                         <input name="email" type="email" placeholder="Nhập email của bạn" >
                    </div>

                    <div class="form-control">
                         <label>Mật khẩu</label>
                         <input name="password" type="password" placeholder="Nhập mật khẩu của bạn" >
                    </div>

                    <a href="?act=forget-password" class="form-text">Quên mật khẩu</a>

                    <button name="btn-register" class="form-btn" >Đăng ký</button>
               </form>
          </div>
     </div>
</body>
</html>