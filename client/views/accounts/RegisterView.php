<?php 

namespace Views\Accounts;

class RegisterView {
     function registerRender($errors = []) {
     ?>
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
                              <?php if (isset($errors['fullName'])): ?>
                                   <div class="error-message"><?php echo $errors['fullName']; ?></div>
                              <?php endif; ?>
                         </div>

                         <div class="form-control">
                              <label>Email</label>
                              <input name="email" type="email" placeholder="Nhập email của bạn" >
                              <?php if (isset($errors['email'])): ?>
                                   <div class="error-message"><?php echo $errors['email']; ?></div>
                              <?php endif; ?>
                         </div>

                         <div class="form-control">
                              <label>Mật khẩu</label>
                              <input name="password" type="password" placeholder="Nhập mật khẩu của bạn" >
                              <?php if (isset($errors['password'])): ?>
                                   <div class="error-message"><?php echo $errors['password']; ?></div>
                              <?php endif; ?>
                         </div>

                         <a href="?act=forget-password" class="form-text">Quên mật khẩu</a>

                         <button name="btn-register" class="form-btn" >Đăng ký</button>
                    </form>
               </div>
          </div>
     </body>

     <?php }
}
?>