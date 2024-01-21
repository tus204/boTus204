<?php 
    session_start();
    $userName = $_SESSION['full_name'];
    $userEmail = $_SESSION['email'];
    $userAvatar = $_SESSION['avatar'];
    $userGender = $_SESSION['gender'];
    $userMobile = $_SESSION['mobile'];
?>
<main class="main">
    <div class="container">
        <div class="profile">
            <div class="profile-main">
                <div class="options">
                    <h2 class="option-heading">Cài Đặt</h2>
                    <ul class="option-sidebar">
                        <li class="active">
                            <i class="fa-solid fa-user"></i>
                            <a href="">Cài đặt tài khoản</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-shield-halved"></i>
                            <a href="">Đăng nhập và bảo mật</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-bell"></i>
                            <a href="">Cài đặt thông báo</a>
                        </li>
                    </ul>
                </div>
                <div class="profile-info">
                    <h2 class="profile-heading">Thông tin cá nhân</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="info-list">
                            <div class="info-item">
                                <h2 class="info-heading">Họ và tên</h2>
                                <input type="text" name="full_name" value="<?php echo $userName; ?>" />
                                <span>Tên của bạn xuất hiện trên trang cá nhân và bên cạnh các bình luận của bạn.</span>
                            </div>

                            <div class="info-item">
                                <h2 class="info-heading">Avatar</h2>
                                <input name="image" type="file" />
                                <img src="<?php echo $userAvatar; ?>" alt="avatar" />
                                <span>Nên là ảnh vuông, chấp nhận các tệp: JPG, PNG hoặc GIF.</span>
                            </div>

                            <div class="info-item">
                                <h2 class="info-heading">Email</h2>
                                <input name="email" type="email" value="<?php echo $userEmail; ?>" />
                            </div>

                            <div class="info-item">
                                <h2 class="info-heading">Số Điện Thoại</h2>
                                <input type="text" name="mobile" value="<?php echo $userMobile; ?>" placeholder="Nhập số điện thoại" />
                                <span>Điện thoại liên kết với VietNamHistory</span>
                            </div>

                            <div class="info-item">
                                <h2 class="info-heading">Chọn giới tính của bạn</h2>
                                <select name="gender" class="genderSelect">
                                    <option value="" seleted>Chọn giới tính</option>
                                    <option value="Nam" <?= ($userGender ?? '') === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                                    <option value="Nữ" <?= ($userGender ?? '') === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                                    <option value="Khác" <?= ($userGender ?? '') === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                                </select>
                            </div>

                            <button type="submit" name="btn-save" class="btn btn-profile">Lưu thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
