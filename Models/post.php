<?php
// Hàm thêm bài viết
function insert_post($post_title, $post_content, $post_time,$user_id,$image,$category_id){
    $sql = "INSERT INTO `posts`( `post_title`, `post_content`, `post_time`,`user_id`, `image`, `category_id`) VALUES ('$post_title','$post_content','$post_time','$user_id','$image','$category_id')";
    pdo_execute($sql);
}
// hàm lấy thông tin của tất bài viết
function loadall_post(){
    $sql ="SELECT us.full_name as full_name,us.image as image_user , po.post_title, po.post_content, po.post_time , po.image , po.category_id,po.post_id, po.post_id , po.user_id , ca.category_name as category_name
     FROM posts as po
    INNER JOIN users as us
    ON po.user_id = us.user_id
    INNER JOIN categories as ca
    ON po.category_id = ca.category_id
     ORDER BY post_id ";
    $listpost= pdo_query($sql);
    return $listpost;
}   
// Hàm xóa bài viết
function delete_post(){
    $sql = "DELETE FROM posts WHERE post_id=".$_GET['id'];
    pdo_execute($sql);
}
// hàm lấy thông tin của một bài viết theo id 
function loadone_post(){
    $sql = "SELECT * FROM posts WHERE post_id=".$_GET['id'];
    $post = pdo_query_one($sql);
    return $post;
}
// hàm cập nhật dữ liệu bài viết
function update_post($post_id,$post_title,$post_content,$post_time,$image,$category_id){
    $sql = "UPDATE `posts` SET `post_title`='$post_title',`post_content`='$post_content',`post_time`='$post_time',`image`='$image',`category_id`='$category_id' WHERE post_id=".$post_id;
    pdo_execute($sql);
}
// Hàm xóa bài viết khi danh mục bị xóa
function delete_post_category(){
    $sql = "DELETE FROM posts WHERE category_id=".$_GET['id'];
    pdo_execute($sql);
}
// Hàm thêm blog
function insert_blog($title_blog, $edit_blog, $blog_time,$user_id,$category_id,$image_blog){
    $sql = "INSERT INTO `posts`( `post_title`, `post_content`, `post_time`,`user_id`,`category_id`,`image`) VALUES ('$title_blog','$edit_blog','$blog_time','$user_id','$category_id','$image_blog')";
    pdo_execute($sql);
}
// Hàm lấy dữ liệu của 1 bài viết theo id trong blog
function loadone_blog(){
    $sql = "SELECT us.full_name as full_name,us.image as image_user ,po.view, po.post_title, po.post_content, po.post_time , po.image , po.category_id,po.post_id, po.post_id , po.user_id , ca.category_name as category_name
    FROM posts as po
   INNER JOIN users as us
   ON po.user_id = us.user_id
   INNER JOIN categories as ca
   ON po.category_id = ca.category_id
   WHERE post_id=".$_GET['id'];
    $blog = pdo_query_one($sql);
    return $blog;
}
// Hàm tính tổng lượt tim bài viết
function blog_view(){
    $sql = "UPDATE posts SET view = view+1 WHERE post_id=".$_GET['id'];
    pdo_query($sql);
}
// Hàm lấy dữ liệu bài viết theo lượt view
function blog_top(){
    $sql = "SELECT us.full_name as full_name,us.image as image_user ,po.view, po.post_title, po.post_content, po.post_time , po.image , po.category_id,po.post_id, po.post_id , po.user_id , ca.category_name as category_name
    FROM posts as po
   INNER JOIN users as us
   ON po.user_id = us.user_id
   INNER JOIN categories as ca
   ON po.category_id = ca.category_id
   WHERE post_id ORDER BY view DESC LIMIT 0,8";
    $top_blog = pdo_query($sql);
    return $top_blog;
}
// Hàm đếm số bình luận
function total_cmt($post_id){
    $sql = "SELECT COUNT(co.comment_id) AS total_cmt 
    FROM posts AS po 
    INNER JOIN comments AS co ON po.post_id = co.post_id 
    WHERE po.post_id = ?";
    $comment = pdo_query($sql, $post_id);
    return $comment;
}
?>