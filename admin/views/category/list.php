<table class="table mt-4">
<br>
     <br>
     <h2 class="text-center text-primary mt-3">List Category</h2>
     <thead>
     <tr>
          <th scope="col">#</th>   
          <th scope="col">Category Name</th>
          <th scope="col">Action</th>
     </tr>
     </thead>
     <tbody>
     <tr>
          <?php
           foreach ($listcategory as $category) {
              extract($category); 
              $suacate = "index.php?act=edit-category&id=".$category_id;
              $xoacate = "index.php?act=delete-category&id=".$category_id;
          ?>
              <tr> <td scope="row"> <?=$category_id?> </td>
              <td scope="row"><?=$category_name?></td>
              <td>
              <a href="<?=$suacate?>"><button type="button" class="btn btn-warning" name="edit-category">Edit</button></a>
              <a href="<?=$xoacate?>"><button type="button" class="btn btn-danger" name="deletecate" onclick="return confirm('Những bài viết trong danh mục này cũng sẽ bị xóa, xác nhận ?')">Delete</button></a>
              <a href="index.php?act=add-course" class="btn btn-primary">Add Course</a>
          </td> </tr>
          <?php }?>

     
     </tbody>
</table>
<a href="index.php?act=add-category" class="btn btn-primary">Add Category</a>