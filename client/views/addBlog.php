<main class="main">
    <div class="container">
        <div class="main-layout">
            <form class="add-blog-1" method="POST" action="index.php?act=add-blog" method="POST" enctype="multipart/form-data" >
            <label>Chọn Danh Mục Cho Bài Viết Của Bạn</label>
                <select class="blog-category" name="category_id" style="width: 100%">
                        <?php
                            foreach ($listcategory as $category) {
                                extract($category);
                                echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                            }
                        ?>
                </select>
                <input name="title_blog" class="blog-name-heading" placeholder="Tiêu đề" />
                <textarea id="editor" name="edit_blog" placeholder="Enter course content" require></textarea>
                <div class="blog-add-img">
                    <label>Chọn ảnh bìa cho bài viết</label> <br>
                    <input type="file" name="image_blog" id="">
                </div>
                <button class="btn" name="add-blog">Xuất bản</button>
            </form>
        </div>
    </div>
</main>
<script>
    document.title = "VietNam History";
    let title = document.querySelector(".blog-name-heading");
    title.addEventListener("input", function (e) {
        document.title = e.target.value;
        if (title = "") {
            document.title = "VietNam History";
        }
    });
</script>
