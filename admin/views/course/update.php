<form class="mt-4 d-flex flex-column gap-2" enctype="multipart/form-data" method="POST">
<br>
     <br>
    <h2 class="text-center text-primary">Edit Course</h2>
    <div class="form-group">
        <label>Course Name</label>
        <input type="text" name="course_name" class="form-control"  placeholder="Enter course name" value="<?= $course['course_name'] ?>" require>
    </div>

    <div class="form-group">
        <label>Course Title</label>
        <input type="text" name="course_title" class="form-control"  placeholder="Enter course title" value="<?= $course['title'] ?>" require>
    </div>

    <div class="form-group">
        <label>Quiz Video (Link)</label>
        <input type="text" name="course_video" class="form-control" placeholder="Enter course video" value="<?= $course['video'] ?>" require>
    </div>

    <div class="form-group">
        <label>Course Content</label>
        <textarea type="text" name="course_content" class="form-control" placeholder="<?= isset($course['content']) ? '' : 'Enter course' ?>" value="" require><?= isset($course['content']) ? $course['content'] : '' ?></textarea>
    </div>

    <div class="form-group">
        <label>Course Desc</label>
        <textarea type="text" name="course_desc" class="form-control" placeholder="Enter desc" value="<?= isset($course['desc']) ? '' : 'Enter course desc' ?>" require><?= isset($course['desc']) ? $course['desc'] : '' ?></textarea>
    </div>

    <div class="form-group">
        <label>Course Image</label>
        <input type="file" name="course_image" class="form-control" placeholder="Enter course image" value="">
        <br>
        <img src="<?= $course['image'] ?>" alt="ảnh course" width="200px">
    </div>

    <div class="d-flex justify-content-between"> 
        <button type="submit" name="submit" class="btn btn-primary w-25 mt-4">Submit</button>
        <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
    </div>
</form>