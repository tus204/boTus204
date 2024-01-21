<form class="mt-4 d-flex flex-column gap-2" id="add-category"aciton="index.php?act=add-category" method="POST">
    <br>
     <h2 class="text-center text-primary">Add new category</h2>
     <div class="form-group">
          <label>Lesson Category Name</label>
          <input type="text" class="form-control" placeholder="Enter Lesson category name" require id="lesson_category_name" name="lesson_category_name">
          <span class="error" id="lesson_category_name_error" style="color:red"></span>
     </div>
     </div>
     <div class="d-flex justify-content-between"> 
          <button type="submit"  class="btn btn-primary w-25 mt-4" name="add_lesson_category">Submit</button>
          <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
     </div>

</form>
