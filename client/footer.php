<footer class="footer">
    <div class="container">
        <div class="footer-row">
            <div class="footer-column">
                <h3 class="footer-heading">VietNam History</h3>
                <a href="">Điện thoại: 0352223905</a>
                <a href="">Email: huynqph37225@fpt.edu.vn</a>
                <a href="">Cao đẳng FPT Phố Trịnh Văn Bô, Phường Phương Canh, Quận Từ Liêm, Hà Nội</a>
            </div>
            <div class="footer-column">
                <h3 class="footer-heading">Về chúng tôi</h3>
                <a href="">Giới thiệu</a>
                <a href="">Liên hệ</a>
                <a href="">Điều khoản</a>
                <a href="">Bảo mật</a>
            </div>
            <div class="footer-column">
                <h3 class="footer-heading">Liên hệ với chúng tôi</h3>
                <a href="">
                    <i class="fa-brands fa-square-facebook"></i>
                    Facebook
                </a>
                <a href="">
                    <i class="fa-brands fa-youtube"></i>
                    Youtube
                </a>
                <a href="">
                    <i class="fa-solid fa-envelope"></i>
                    Gmail
                </a>
            </div>
            <div class="footer-column">
                <h3 class="footer-heading">Nhận thông báo</h3>
                <div>
                    <input class="footer-input" placeholder="Enter your email">
                    <button class="footer-btn">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script src="./js/home.js"></script>
<script src="./js/quiz.js"></script>
<script src="./js/lern.js"></script>
<script>
     ClassicEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder:
            {
                uploadUrl: 'fileupload.php'
            }
        })
        .then(editor =>{
            console.log(editor);
        })
        .catch( error => {
            console.error( error );
        } );
</script>
</html>