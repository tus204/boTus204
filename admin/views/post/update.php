<?php
  extract($post);
  if (is_file('../upload/' . $image)) {
     $image = "<img src='" . ('../upload/' . $image) . "' width='150'>";
   } else {
     $image = "no photo";
   }
?>


<form class="mt-4 d-flex flex-column gap-2" action="index.php?act=update-post" method="POST"  enctype="multipart/form-data">
     <h2 class="text-center text-primary">Update post</h2>
     <div class="form-group">
          <label>Post Name</label>
          <input type="text" class="form-control"  placeholder="Enter post name" require name="post_title" value="<?=$post_title?>">
     </div>

     <div class="form-group">
          <label>Post Content</label>
          <textarea row="3" class="form-control" placeholder="Enter post content" require name="post_content" ><?php echo $post_content ?></textarea>
     </div>

     <div class="form-group">
          <label>Post image</label>
          <input type="file" class="form-control" name="post_image"   >
          <?=$image?>
     </div>

     <div class="form-group">
          <label>Select Category</label>
          <select class="form-control" name="category_id">
<?php
    foreach ($listcategory as $category) {
          extract($category);
          echo '<option value="'.$category_id.'" selected>'.$category_name.'</option>';
    }
?>

          </select>
     </div>

     <div class="d-flex justify-content-between"> 
          <input type="hidden" name="post_id" value="<?=$post_id?>">
          <button type="submit" class="btn btn-primary w-25 mt-4" name="update_post">Submit</button>
          <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
     </div>
</form>