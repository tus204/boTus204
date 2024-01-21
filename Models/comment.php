<?php
function loadall_comment(){
    $sql ="SELECT us.full_name as full_name,po.post_title as post_name, co.comment_id ,co.user_id, co.post_id, co.comment_text, co.comment_time
    FROM comments as co
    INNER JOIN users as us
    ON co.user_id = us.user_id
    INNER JOIN posts as po
    on co.post_id= po.post_id
    
    ORDER BY comment_id";
    $listcomment = pdo_query($sql);
    return $listcomment;
}
function delete_comment(){
    $sql ="DELETE FROM comments WHERE comment_id=".$_GET['id'];
    pdo_execute($sql);
}
// Hàm xóa cmt theo bài viết : Nếu bài viết bị xóa thì tất cả cmt trong bài viết đó cũng bị xóa
function delete_comment_by_pots(){
    $sql="DELETE FROM comments WHERE post_id=".$_GET['id'];
    pdo_execute($sql);
}
?>