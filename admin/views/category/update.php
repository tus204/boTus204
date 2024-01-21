<?php

if(isset($category)){
    extract($category);
}


?>


<form class="mt-4 d-flex flex-column gap-2" action="index.php?act=update-category" method="POST">
<br>
     <br>
     <h2 class="text-center text-primary">Update category</h2>
     <div class="form-group">
          <label>Category Name</label>
          <input type="text" class="form-control" name="category_name"  placeholder="Enter category name" require
           value="<?php if(isset($category_name)&&$category_name!="") echo $category_name; ?>">
     </div>

     <div class="d-flex justify-content-between">
          <input type="hidden" name="category_id" value="<?=$category_id?>">
          <button type="submit" class="btn btn-primary w-25 mt-4" name="update_category">Submit</button>
          <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
     </div>
</form>