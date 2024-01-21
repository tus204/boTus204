<div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Statistics</span>
            </div>

            <div class="boxes">
                <div class="box box1">
                    <i class="uil uil-book-alt"></i>
                    <span class="text">Total Courses</span>
                    <span class="number"><?= $getTotalCourses['total_courses'] ?></span>
                </div>
                <div class="box box2">
                    <i class="uil uil-question-circle"></i>
                    <span class="text">Total Quizes</span>
                    <span class="number"><?= $getTotalQuizes['total_quizes'] ?></span>
                </div>
                <div class="box box3">
                    <i class="uil uil-question"></i>
                    <span class="text">Total Questions</span>
                    <span class="number"><?= $getTotalQuestions['total_questions'] ?></span>
                </div>
                <div class="box box4">
                    <i class="uil uil-align-left"></i>
                    <span class="text">Total Categories</span>
                    <span class="number"><?= $getTotalCategories['total_categories'] ?></span>
                </div>
                <div class="box box5">
                    <i class="uil uil-newspaper"></i>
                    <span class="text">Total Posts</span>
                    <span class="number"><?= $getTotalPosts['total_posts'] ?></span>
                </div>
                <div class="box box6">
                    <i class="uil uil-comment-alt-dots"></i>
                    <span class="text">Total Comments</span>
                    <span class="number"><?= $getTotalComments['total_comments'] ?></span>
                </div>
                <div class="box box7">
                    <i class="uil uil-users-alt"></i>
                    <span class="text">Total Users</span>
                    <span class="number"><?= $getTotalUsers['total_users'] ?></span>
                </div>
            </div>
        </div>        
    </div>
</section>