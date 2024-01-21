<table class="table mt-4">
     <br>
     <br>
     <h2 class="text-center text-primary mt-3">List Post</h2>
     <thead>
     <tr>
          <th scope="col">#</th>   
          <th scope="col">Post Name</th>
          <th scope="col">Post Time</th>
          <th scope="col">Post Image</th>
          <th scope="col">Created by</th>
          <th scope="col">Action</th>
     </tr>
     </thead>
     <tbody>
          <?php
           foreach ($listpost as $post) {
               extract($post);
               if(is_file('../upload/'.$image)) {
                    $hinh = "<img src='".('../upload/'.$image)."' width='100'>";
                } else {
                    $hinh = "no photo";
                } 
               $editpost ="index.php?act=edit-post&id=".$post_id;
               $xoapost ="index.php?act=delete-post&id=".$post_id;
               ?>
                  <tr>
               <th scope="row"><?=$post_id?></th>
               <td style="max-height: 50px; overflow: hidden; max-width: 900px;"><?=$post_title?></td>
               <td><?=$post_time?></td>
               <td><?=$hinh?></td>
               <td><?=$full_name?></td>
               <td>
               <a href="<?=$editpost?>"> <button type="button" class="btn btn-warning">Edit</button></a>
               <a href="<?=$xoapost?>">  <button type="button" class="btn btn-danger" onclick="return confirm('Xác nhận xóa người dùng này ?')">Delete</button></a>
               </td>
          </tr>
          <?php
           }
          ?>
     </tbody>
</table>
<a href="index.php?act=add-post" class="btn btn-primary">Add Post</a>