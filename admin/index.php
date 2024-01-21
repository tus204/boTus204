<?php
     session_start();

     // Kiểm tra xem người dùng đã đăng nhập và có role là "Admin" không
     if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
     // Nếu không phải admin, chuyển hướng về trang chủ ngay lập tức
     header("Location: /VietNamHistory/client/");
     exit();
     }

     include_once ('../models/validate.php');
     include_once ('../models/comment.php');
     include_once ('../models/user.php');
     include_once ('../models/post.php');
     include_once ('../models/categories.php');
     include_once ('../models/quiz.php');
     include_once ('../models/pdo.php');
     include_once ('./header.php');
     include_once ('../models/course.php');
     include_once ('../models/status.php');
     include_once ('../models/lesson_cate.php');
     include_once ('../models/lesson.php');
     $error=[];
if(isset($_GET['act'])) {
     $act = $_GET['act'];
     switch ($act) {

          case 'list-user':
               $users = getAllUsers();
               include_once('./views/user/list.php');
               break;

          case 'update-user':            
               if(isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];
                    $user = getUserById($user_id);
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                         $full_name = $_POST['full_name'];
                         $email = $_POST['email'];
                         $mobile = $_POST['mobile'];
                         $role = $_POST['role'];
                         $gender = $_POST['gender'];
                         $image = $_FILES['image'];

                         // Gọi hàm cập nhật người dùng
                         updateUser($user_id, $full_name, $email, $mobile, $role, $gender, $image);

                         // chuyển hướng về list
                         header("Location: ?act=list-user");
                         exit();
                    } else {
                         include_once('./views/user/updateUser.php');
                    }
               }
               break;
               
          case 'delete-user':
               if(isset($_GET['user_id']) && $_GET['user_id']>0) {
                    $user_id_to_delete = $_GET['user_id'];
                    
                    // Gọi hàm xóa người dùng
                    delUser($user_id_to_delete);
               
                    // chuyển hướng     
                    header("Location: ?act=list-user");
                    exit();
               }
               break;

          case 'list-course':
               $courses = getCourseList();
               $listcategory = loadall_category();
               // $courseId = $course['course_id'];
               include_once('./views/course/list.php');
               break;

          case 'add-course':    
               $listcategory = loadall_category();           
               if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    $courseName = $_POST['course_name'];
                    $courseTitle = $_POST['course_title'];
                    $courseVideo = $_POST['course_video'];
                    $courseContent = $_POST['course_content'];
                    $courseDesc = $_POST['course_desc'];
                    $category = $_POST['category_id'];
                    $image_path = $_FILES['course_image'];
                     // Thực hiện thêm khóa học mới

                    addCourse($courseName, $courseTitle, $courseVideo, $courseContent, $courseDesc, $category, $image_path);
                    // chuyển hướng về list
                    header("Location: ?act=list-course");

               }
               include_once('./views/course/add.php');
               break;

          case 'update-course':               
               if(isset($_GET['course_id'])) {
                    $courseId = $_GET['course_id'];
                    $course = getCourseListById($courseId);

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $courseName = $_POST['course_name'];
                    $courseTitle = $_POST['course_title'];
                    $courseVideo = $_POST['course_video'];
                    $courseContent = $_POST['course_content'];
                    $courseDesc = $_POST['course_desc'];
                    $image_path = $_FILES['course_image'];

                    // Thực hiện update course
                    updateCourse($courseId, $courseName, $courseTitle, $courseVideo, $courseContent, $courseDesc, $image_path);
                    // chuyển hướng về list
                    header("Location: ?act=list-course");
                    }

               } 
               include_once ('./views/course/update.php');
               break;

          case 'delete-course':
               if(isset($_GET['course_id'])) {
                    $courseId = $_GET['course_id'];
                    $course = getCourseListById($courseId);
                    
                    // xóa course
                    
                    quiz::delQuiz($courseId);
                    delUserCourse($courseId);
                    delCourse($courseId);
                    header("Location: ?act=list-course");
               }
               break;
          case 'add-lesson-cat':  
               if(isset($_POST['add_lesson_category'])){
                    $lesson_category_name = $_POST['lesson_category_name'];
                    $course_id =$_GET['id'];
                    add_lesson_cat($lesson_category_name,$course_id);
                    header("Location: ?act=list-lesson-cat&id=".$_GET['id']);
                    exit();

               }             
               include_once('./views/lesson_category/add.php');
               break;     

          case 'list-lesson-cat':             
              if($_GET['id']){
               $listlessoncat = Getall_lesson_cat();
              }
              $listcourse = getCourseList();
               include_once('./views/lesson_category/list.php');
               break;   
          case 'delete-lesson-cat':   
               if(isset($_GET['id']) && $_GET['id']>0 ){
                    delete_lesson_byLC();
                    delete_lesson_cat();
                    }
             
               header("Location: ?act=list-lesson-cat&id=".$_GET['course_id']);
               exit();
               break;   


          case 'update-lesson-cat':  
               if(isset($_GET['id'])){
                    $lesson_cat = Get_lesson_cat_byId($_GET['id']);

                  if(isset($_POST['update_lesson_category']))  {
                    $lesson_cat_name =$_POST['lesson_category_name'];
                    update_lesson_cat_byId($lesson_cat_name);
                    header("Location: ?act=list-lesson-cat&id=".$_GET['course_id']);
                    exit();
                  }
               }
               include_once('./views/lesson_category/update.php');
               break;                
          case 'add-lesson':
               $lessonCat = getAllLessonCate();
               if(isset($_POST['add-lesson'])){
                    $lesson_name = $_POST['lesson_name'];
                    $video = $_POST['video'];
                    $desc = $_POST['description'];
                    $stt = $_POST['stt'];
                    $lesson_cat_id = $_GET['id'];
                    Add_lesson($lesson_cat_id,$lesson_name,$video,$desc,$stt);
                    header("Location: ?act=list-lesson&id=".$_GET['id']);
                    exit();
               }
               include_once('./views/lesson/add.php');
               break;
     
          case 'list-lesson':
               if($_GET['id']){
               $listLesson = GetAll_lesson();
               }
               $listlessoncatid = Getall_lesson_cat();
               include_once('./views/lesson/list.php');
               break;

          case 'delete-lesson':
               if(isset($_GET['id']) && $_GET['id']>0 ){
                    delete_lesson();
                    }
               header("Location: ?act=list-lesson&id=".$_GET['lesson_cat_id']);
               exit();
               $listlessoncatid = Getall_lesson_cat();
               include_once('./views/lesson/list.php');
               break;
          case 'update-lesson':
               if(isset($_GET['id'])){
                    $lesson = Get_lesson_byId($_GET['id']);
                    if(isset($_POST['update-lesson'])){
                         $lesson_name = $_POST['lesson_name'];
                         $video = $_POST['video'];
                         $desc = $_POST['description'];
                         update_lesson($lesson_name,$video,$desc);
                         header("Location: ?act=list-lesson&id=".$_GET['lesson_cat_id']);
                         exit();
                    }
               }
               include_once('./views/lesson/update.php');
               break;
     
          case 'add-quiz':           
               
               $course = getCourseList();
               if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    $quizName = $_POST['quizName'];
                    $quizTime = $_POST['quizTime'];
                    $createdBy = $_SESSION['user_id'];
                    $quizImage = $_FILES['quizImage'];
                    $courseName = $_POST['course_id'];
                    $lessonCatName = $_POST['lesson_cat_id'];
                    $quizStt = $_POST['quiz_stt'];
                    $sql = quiz::addQuiz($quizName, $quizTime, $quizImage, $createdBy, $courseName, $lessonCatName, $quizStt);

                    // echo $sql;
                    header("Location: ?act=list-quiz");
               }
               include_once('./views/quiz/add.php');
               break;

          case 'list-quiz':              
               $quiz = quiz::getAllQuiz();
               include_once('./views/quiz/list.php');
               break;

          case 'delete-quiz':
               if(isset($_GET['id']) && $_GET['id']>0) {
                    $quizId = $_GET['id'];

                    // xóa quiz
                    quiz::delQuiz($quizId);
                    
                    // chuyển hướng
                    header('Location: ?act=list-quiz');
               }
               break;

          case 'list-questions':
               $questions = Quiz::getAllQuestions();
               
               include_once ('./views/question/list.php');
               break;

          case 'add-question':
               if(isset($_GET['quiz_id'])) {
                    $quizId = $_GET['quiz_id']; 
                    $questions = Quiz::getQuestionByQuizId($quizId);              
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
                              $questionText = $_POST['questionText'];
                              $image = $_FILES['image'];
                              $correctContent = $_POST['correct-content'];
                              $answers = array($_POST['answer1'], $_POST['answer2'], $_POST['answer3'], $_POST['answer4']);
                              $correctAnswerName = $_POST['correctAnswer'];
                              $correctAnswerText = $_POST[$correctAnswerName];                      
                              
                              // Quiz::getAllAnswersByQuestionId($questionId);
                              // Thêm question + answers
                              $questionId = Quiz::addQuestion($questionText, $quizId, $answers, $image);
                              // Lấy answer_id của đáp án đúng
                              $correctAnswerId = Quiz::getAnswerIdByAnswerText($questionId, $correctAnswerText);
                              echo $correctAnswerId;
                              // thêm đáp án đúng
                              var_dump($correctAnswerText, $correctAnswerId);
                              Quiz::addCorrectAnswer($questionId, $correctAnswerId, $correctContent);
                              var_dump($_POST);
                              header ("Location: ?act=add-question&quiz_id=$quizId");
                    }
               }
               
               include_once ('./views/question/list.php');
               break;

          case 'add-category':
               if(isset($_POST['add_category']) ){
                    $category_name = $_POST['category_name'];
                    insert_category($category_name);
                    header("Location: ?act=list-categories");
                    exit();
               }
               include_once('./views/category/add.php');
               break;

          case 'list-categories':
               $listcategory = loadall_category();
               include_once('./views/category/list.php');
               break;

          case 'delete-category':
               if(isset($_GET['id']) && $_GET['id']>0 ){
               delete_post_category();
               delete_category();
               
               }
               $listcategory = loadall_category();
               include_once('./views/category/list.php');
               break;

          case 'edit-category':
               if(isset($_GET['id'])&& $_GET['id']>0){
               $category = loadone_categories($_GET['id']);

               }
               $listcategory = loadall_category();
               include_once('./views/category/update.php');
               break;
               
          
          case 'update-category':
               if(isset($_POST['update_category']) ){
                    $category_name = $_POST['category_name'];
                    $category_id =$_POST['category_id'];
                    update_category($category_id,$category_name);
                    }
               $listcategory = loadall_category();
               include_once('./views/category/list.php');
               break;

          case 'add-post':
               if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['add-post'])){
                    $post_title = $_POST['post_title'];
                    $post_content = $_POST['post_content'];
                    $post_time = date("Y-m-d H:i:s"); 
                    $user_id = $_SESSION['user_id'];
                    $image= basename($_FILES['post_image']['name']);
                    $target_file = "../upload/".$image;                  
                    move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file); 
                    $category_id = $_POST['category_id'];
                    insert_post($post_title, $post_content, $post_time,$user_id,$image,$category_id);               
               }
               $listcategory = loadall_category();
               include_once('./views/post/add.php');
               break;

          case 'list-post':
               $listpost = loadall_post();
               include_once('./views/post/list.php');
               break;
          case 'delete-post':
               if(isset($_GET['id']) && $_GET['id']){
                    delete_comment_by_pots();
                    delete_post();
               }
               $listpost = loadall_post();
               include_once('./views/post/list.php');
               break;          
          case 'edit-post':
               if(isset($_GET['id'])){
                    $post = loadone_post($_GET['id']);
     
                    }
               $listcategory = loadall_category();     
               $listpost = loadall_post();
               include_once "./views/post/update.php";
               break;
          case 'update-post':
               if(isset($_POST['update_post'])){
                    $post_title = $_POST['post_title'];
                    $post_content = $_POST['post_content'];
                    $post_time = date("Y-m-d H:i:s"); 
                    $image= basename($_FILES['post_image']['name']);
                    $target_file = "../upload/".$image;
                    
                    if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)){
                         echo "Thêm thành công !";
                    }
                    
                    $category_id = $_POST['category_id'];
                    $post_id = $_POST['post_id'];
                    update_post($post_id,$post_title,$post_content,$post_time,$image,$category_id);

               
               }
               $listcategory = loadall_category();     
               $listpost = loadall_post();
               include_once "./views/post/list.php";
               break;        

          case 'point':
               include_once('./views/points/list.php');
               break;

          case 'comment':
               $listcomment = loadall_comment();
               include_once('./views/comment/list.php');
               break;
          case 'del-cmt':
               if(isset($_GET['id'])){
                    delete_comment();
               }
               $listcomment = loadall_comment();
               include_once('./views/comment/list.php');
               break;      

          default:
               // thống kê
               break;
     }
}else {
     $getTotalCourses = getTotalCourses();
     $getTotalQuizes = getTotalQuizes();
     $getTotalQuestions = getTotalQuestions();
     $getTotalCategories = getTotalCategories();
     $getTotalPosts = getTotalPosts();
     $getTotalComments = getTotalComments();
     $getTotalUsers = getTotalUsers();
     include_once('./views/statistics/list.php');
}
include_once('./footer.php');

?>
