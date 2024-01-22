<?php

namespace Views\Accounts;

use Controllers\AuthController;

class LoginView extends AuthController {
     function loginReder($error=[]) {
          ?>
     <body>
          <div class="wrapper">
               <div class="container">
                    <form class="login-form" action="" method="post">
                         <h2 class="form-heading">Đăng nhập</h2>
                         <p class="form-desc" >Bạn không có tài khoản ?
                              <a class="text-link" href="?act=register">Đăng ký</a>

                         </p>   

                         <div class="form-control">
                              <label>Email</label>
                              <input name="email" type="email" placeholder="Nhập email của bạn" value="<?=isset($_COOKIE['registered_email']) ? ($_COOKIE['registered_email']) : ''?>">
                              <?php if (isset($error['email'])): ?>
                                   <div class="error-message"><?php echo $error['email']; ?></div>
                              <?php endif; ?>
                         </div>

                         <div class="form-control">
                              <label>Mật khẩu</label>
                              <input name="password" type="password" placeholder="Nhập mật khẩu của bạn" value="<?=isset($_COOKIE['registered_password']) ? ($_COOKIE['registered_password']) : ''?>">
                              <?php if (isset($error['password'])): ?>
                                   <div class="error-message"><?php echo $error['password']; ?></div>
                              <?php endif; ?>
                         </div>

                         <a href="?act=forget-password" class="form-text">Quên mật khẩu</a>
                         <button name="btn-login" class="form-btn" >Đăng nhập</button>

                    </form>
               </div>
          </div>
     </body>
     </html>
     <?php }
}
?>