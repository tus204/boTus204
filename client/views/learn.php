<main class="main">
    <div class="container">
        <div class="main-layout">
            <div class="learn">
                <!-- check cái url -> get dữ liệu -> nếu mà nó có videos thì hiện video còn không có video hiện quzi -> toán tử 3 ngôi -->

                <div class="learn-left">
                    <div class="learn-video">
                        <iframe class="learn-videos" src="https://www.youtube.com/embed/<?=$courseDetail['video']?>" frameborder="0" allowfullscreen> </iframe>
                    </div>                    
                </div>
                <div class="learn-lesson">
                    <div id="course-tree">
                        <?php foreach ($lessonCats as $lessonCat) : ?>
                        <div class="course-learn course-learn-<?= $lessonCat['lesson_cat_id'] ?>" onclick="toggleCourse(<?= $lessonCat['lesson_cat_id'] ?>)">
                            <h3><?= $lessonCat['lesson_cat_name'] ?></h3>   
                            <div id="sub-courses-<?= $lessonCat['lesson_cat_id'] ?>" class="sub-courses"></div>
                        </div>
                        <?php endforeach; ?>
                        <?php foreach ($lessonCats as $lessonCat) : ?>
                        <script>
                            const subCourseData<?= $lessonCat['lesson_cat_id'] ?> = `
                            <?php
                            $lessonsAndQuizzes = getLessonsAndQuizesById($lessonCat['lesson_cat_id']);
                            foreach ($lessonsAndQuizzes as $lessonAndQuiz) :
                            ?>
                                <div class="sub-course">
                                    <h4><?= $lessonAndQuiz['name'] ?></h4>
                                    <div type="hidden"><?=$lessonAndQuiz['type']?></div>
                                </div>
                            <?php endforeach; ?>
                            `;
                        </script>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>
<!-- Bạn Tú gà VL luôn đấy cứ phá lung tung giờ lỗi tùm lum -->
<script>
    
    function toggleCourse(courseId) {
        const course = document.querySelector(`.course-learn-${courseId}`);
        const subCourses = course.querySelector('.sub-courses');
        localStorage.setItem('course_id',course);

        course.classList.toggle('active');
        subCourses.classList.toggle('active');

        const hasData = subCourses.innerHTML.trim().length > 0;

        if (!hasData) {
            const subCourseData = getSubCourseData(courseId);
            appendSubCourseData(subCourses, subCourseData);
        }
    }

    function getSubCourseData(courseId) {
        <?php
        $lessonsAndQuizzes = getLessonsAndQuizesById(6);
        $subCourseData = [];
        foreach ($lessonsAndQuizzes as $lessonAndQuiz) {
            $subCourseData[] = [
                'name' => $lessonAndQuiz['name'],
                'id' => $lessonAndQuiz['id'],
                'type' => $lessonAndQuiz['type']
            ];
        }
        echo 'return ' . json_encode($subCourseData) . ';';
        ?>
    }

    function appendSubCourseData(container, data) {
        data.forEach(item => {
            const subCourse = document.createElement('div');
            subCourse.className = 'sub-course';

            const link = document.createElement('a');
            link.href = item.type === 'lesson' ? 'index.php?act=lesson&course_id=<?=$courseId?>&id=' + item.id : 'index.php?act=quiz&course_id=<?=$courseId?>&id=' + item.id;

            const heading = document.createElement('h4');
            heading.textContent = item.name;

            link.appendChild(heading);
            subCourse.appendChild(link);

            container.appendChild(subCourse);
        });
    }
</script>
