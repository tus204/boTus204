<?php
    ini_set('display_errors', 1);
    session_start();
    ob_start();
    include_once ('../models/pdo.php');
    include_once ('../models/course.php');
    include_once ('../models/user.php');
    include_once ('../models/post.php');
    include_once ('../models/categories.php');
    include_once ('../models/quiz.php');
    include_once ('../models/lesson.php');
    $conn = pdo_get_connection();
    $top9 = blog_top();
    include_once ('./header.php');
    if(isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'register':
            include_once ('./views/accounts/register.php');
            if (isset($_POST['btn-register'])) {
                $fullName = $_POST['fullName'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash mật khẩu
                // $password = $_POST['password']; 
                echo "Full Name: $fullName, Email: $email, Password: $password";
        
                // thêm thông tin người dùng vào cơ sở dữ liệu
                $sql = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
                echo "Câu lệnh SQL: $sql";
                
                if ($conn->query($sql)) {
                    echo "Đăng ký thành công";
                    header("Location: ?act=login"); // chuyển hướng sang trang login khi đăng kí thành công
                } else {
                    $errorInfo = $conn->errorInfo();
                    echo "Đăng ký thất bại !!!: " . $sql . "<br>" . $errorInfo[2];
                }
            }
            break;

            case 'login':
                include_once ('./views/accounts/login.php');
                if (isset($_POST['btn-login'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
            
                    // kiểm tra đăng nhập
                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $result = $conn->query($sql);
            
                    if ($result->rowCount() > 0) {
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        if (password_verify($password, $row['password'])) {
                            // Đăng nhập thành công, lưu thông tin người dùng vào session
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['full_name'] = $row['full_name'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['role'] = $row['role'];
                            $_SESSION['mobile'] = $row['mobile'];
                            $_SESSION['gender'] = $row['gender'];
                            $row['image'] ? $_SESSION['avatar'] = $row['image'] : $_SESSION['avatar'] = "https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg";
                            
                            
                            // Chuyển hướng
                            if ($_SESSION['role'] == 'Admin') {
                                header("Location: /VietNamHistory/client/");
                            } elseif ($_SESSION['role'] == 'Client') {
                                header("Location: /VietNamHistory/client/");
                            } 
                            } else {
                                echo "Mật khẩu không đúng";
                        } 
                    } else {
                        echo "Người dùng không tồn tại";
                        }
                }
                break;

            case 'forget-password':
                include_once ('./views/accounts/forgetPassword.php');
                if (isset($_POST['btn-forget-password'])) {
                    $email = $_POST['email'];
                    // kiểm tra và gửi email reset mật khẩu
                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $result = $conn->query($sql);
                
                    if ($result->rowCount() > 0) {
                        // chuyển hướng đến trang reset password
                        echo "Gửi email reset mật khẩu thành công. Vui lòng kiểm tra email để đặt lại mật khẩu.";
                        // echo "<br><a href='../views/accounts/resetPassword.php'>Đặt lại mật khẩu</a>";
                        header("Location: ?act=reset-password&email=" . urlencode($email));
                    } else {
                        echo "Người dùng không tồn tại";
                    }
                }
                break;

            case 'reset-password':
                include_once ('./views/accounts/resetPassword.php');
                if (isset($_POST['btn-reset-password'])) {
                    $email = $_POST['email'];
                    $newPassword = $_POST['newPassword'];
                    $confirmPassword = $_POST['confirmNewPassword'];
            
                    if ($newPassword === $confirmPassword) {            
                        $hashePassword = password_hash($newPassword, PASSWORD_BCRYPT);
            
                        // cập nhật mật khẩu trong cơ sở dữ liệu
                        $sql = "UPDATE users SET password='$hashePassword' WHERE email='$email'";
                
                        if ($conn->query($sql)) {
                            echo "Đặt lại mật khẩu thành công";
                            // Chuyển hướng sang trang login khi đặt lại mật khẩu thành công
                            header("Location: ?act=login");
                        } else {
                            echo "Đặt lại mật khẩu thất bại" . $sql . "<br>" . $conn->errorInfo();
                        }
                    } else {
                        echo "Mật khẩu không khớp, vui lòng nhập lại !!!";
                    }
                }
                break;

            case 'logout':
                session_unset();
                session_destroy();
                header("Location: /VietNamHistory/client/");
                break;
            
            case 'course':
                if (isset($_GET['id'])) {
                    $courseId = $_GET['id'];
                    if (isset($_SESSION['user_id'])) {
                        $userId = $_SESSION['user_id'];                
                        // Kiểm tra xem người dùng đã đăng ký khóa học này chưa
                        $checkRegister = checkUserCourse($userId, $courseId);
                        if (!$checkRegister) {
                            // Nếu chưa đăng ký, hiển thị trang course để người dùng đăng ký
                            $courseDetail = getCourseListById($courseId);
                            include_once('./views/course.php');
                            
                        } else {
                            // Nếu đã đăng ký, chuyển hướng người dùng đến trang học
                            header("Location: ?act=learn&course_id=$courseId");
                            exit;
                        }                
                    } else {
                        // Nếu chưa đăng ký, hiển thị trang course để người dùng đăng ký
                        $courseDetail = getCourseListById($courseId);
                        include_once('./views/course.php');
                    }
                }
                break;
            case 'learn':
                include_once('./headerLearn.php');
                if (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];
                    $courseId = $_GET['course_id'];
                    $lessonCats = getLessonCatById($courseId);
                    $courseDetail = getCourseListById($courseId);              

                    // Kiểm tra xem người dùng đã đăng ký khóa học này chưa
                    $checkRegister = checkUserCourse($userId, $courseId);
                    if (!$checkRegister) {
                        // Nếu chưa đăng ký, lưu thông tin đăng ký vào bảng user_course
                        saveUserCourse($userId, $courseId);
                    }

                    if (isset($_GET['id'])) {
                        $quizId = $_GET['id'];
                        $userId = $_SESSION['user_id'];                    
                        $quiz = quiz::getQuizById($quizId);
                        $questions = quiz::getQuestionByQuizId($quizId);
                        // $userAnswers = quiz::getUserAnswer($userId, $quizId, $questionId);
    
                        // // Kiểm tra xem người dùng đã hoàn thành bài kiểm tra chưa
                        // $userQuizStatus = quiz::getUserQuizStatus($userId, $quizId);
                        // if ($userQuizStatus['status'] == 1) {
                        //     // Chuyển hướng đến trang check-point
                        //     header("Location: ?act=check-point&quiz_id=$quizId&totalpoint_id={$userQuizStatus['totalpoint_id']}");
                        //     exit();
                        // }
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                            try {
                                $quizId = $_GET['id'];
                                $questionIds = $_POST['question_id'];
                                $userAnswers = $_POST['answer'];                            
                                $score = 0;
                                
                                // Khi user không trả lời câu nào
                                if (empty($userAnswers)) {
                                    echo"<script>alert('Vui lòng chọn đáp án làm bài !');</script>";
                                    echo"<script>window.history.back();</script>";
                                    return false;
                                }
                                
                                // Khi user không trả lời đủ
                                if (count($questionIds) !== count($userAnswers)) {
                                    echo"<script>alert('Bạn chưa chọn đủ đáp án, vui lòng làm tiếp !');</script>";
                                    echo"<script>window.history.back();</script>";
                                    return false;
                                }                        
                                
                                foreach ($questionIds as $questionId) {                                
                                                                    
                                    // Lấy đáp án đúng cho câu hỏi
                                    $correctAnswers = quiz::getCorrectAnswersByQuestionId($questionId);
                                    extract($correctAnswers);
    
                                    // Lưu đáp án người dùng
                                    Quiz::saveUserAnswer($userId, $questionId, $userAnswers[$question_id], $quizId);
                            
                                    // Kiểm tra xem câu trả lời của người dùng có đúng không
                                    if ($userAnswers[$question_id] == $answer_id) {
                                        // Tăng điểm nếu đúng
                                        $score++;
                                    }
                                }
    
                                // Lưu điểm của người dùng
                                $totalPointId = quiz::saveUserScore($userId, $quizId, $score);
                                
                                // update trạng thái làm bài
                                // Quiz::updateUserQuizStatus($userId, $quizId);
    
                                // Chuyen huong sang trang ket qua
                                // header("Location: ?act=check-point&quiz_id=$quizId&totalpoint_id=$totalPointId"); 
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        }                 
                    }
            
                    // Chuyển hướng người dùng đến trang học                    
                    include_once ('./views/learn.php');
                    exit;
                } else {
                    // Nếu người dùng chưa đăng nhập, chuyển hướng họ đến trang đăng nhập
                    header("Location: index.php?act=login");
                    exit;
                }
                break;
            
            case 'lesson':
                include_once ('./headerLearn.php');
                if(isset($_SESSION['user_id'])){
                    if(isset($_GET['id'])){
                        $user_id = $_SESSION['user_id'];
                        $lesson_id = $_GET['id'];
                        $courseId = $_GET['course_id'];
                        $lessonCats = getLessonCatById($courseId);
                        $lessons = getLessonById($lesson_id);
                    }
                include_once ('./views/lesson.php');
                }
                else{
                    // Nếu người dùng chưa đăng nhập, chuyển hướng họ đến trang đăng nhập
                    header("Location: index.php?act=login");
                    exit;
                }                
                break;
            case 'learning-path':
                include_once('./views/learningPath.php');
                break;

            case 'blog':
                $Blogview = loadall_post();
                include_once('./views/blog.php');
                break;
            case 'my-courses':
                include_once('./views/myCourses.php');
                break;

            case 'add-blog':
                if(isset($_SESSION['user_id'])){
                    if(isset($_POST['add-blog'])){
                        $user_id = $_SESSION['user_id'];
                        $title_blog= $_POST['title_blog'];
                        $edit_blog = $_POST['edit_blog'];
                        $blog_time = date("Y-m-d H:i:s"); 
                        $category_id = $_POST['category_id'];
                        $image= basename($_FILES['image_blog']['name']);
                        $target_file = "../upload/".$image;                  
                        move_uploaded_file($_FILES["image_blog"]["tmp_name"], $target_file); 
                        insert_blog($title_blog, $edit_blog, $blog_time,$user_id,$category_id,$image);
                    }
                    $listcategory = loadall_category();
                include_once('./views/addBlog.php');
                }
                else{
                    // Nếu người dùng chưa đăng nhập, chuyển hướng họ đến trang đăng nhập
                    header("Location: index.php?act=login");
                    exit;
                }
                
                break;
    
            case 'profile':
                include_once ('./views/profile.php');
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-save'])) {
                    $user_id = $_SESSION['user_id'];
                    $full_name = $_POST['full_name'];
                    $email = $_POST['email'];
                    $mobile = $_POST['mobile'];
                    $gender = $_POST['gender'];
                    $image = $_FILES['image'];
                
                    // Gọi hàm cập nhật thông tin người dùng
                    updateProfile($user_id, $full_name, $image, $email, $mobile, $gender);

                    // Cập nhật session sau khi cập nhật thành công
                    $_SESSION['full_name'] = $full_name;
                    $_SESSION['email'] = $email;
                    $_SESSION['mobile'] = $mobile;
                    $_SESSION['gender'] = $gender;
                    $newImagePath = updateImage($image, null);
                    $_SESSION['avatar'] = $newImagePath ?? $_SESSION['avatar'];
                
                    // Chuyển hướng về trang profile sau khi cập nhật thành công
                    header("Location: index.php?act=profile");
                }                
                break;   
            case 'listQuiz':
                if (isset($_GET['id'])) {
                    $courseId = $_GET['id'];  
                    $quizes = quiz::getListQuizByCourseId($courseId);                                      
                }
                include_once('./views/listQuiz.php');
                break;
            case 'quiz':
                include_once ('./headerLearn.php');
                if (isset($_GET['id'])) {
                    $quizId = $_GET['id'];
                    $userId = $_SESSION['user_id'];                    
                    $quiz = quiz::getQuizById($quizId);
                    $courseId = $_GET['course_id'];
                    $lessonCats = getLessonCatById($courseId);
                    $questions = quiz::getQuestionByQuizId($quizId);
                    // $userAnswers = quiz::getUserAnswer($userId, $quizId, $questionId);

                    // // Kiểm tra xem người dùng đã hoàn thành bài kiểm tra chưa
                    // $userQuizStatus = quiz::getUserQuizStatus($userId, $quizId);
                    // if ($userQuizStatus['status'] == 1) {
                    //     // Chuyển hướng đến trang check-point
                    //     header("Location: ?act=check-point&quiz_id=$quizId&totalpoint_id={$userQuizStatus['totalpoint_id']}");
                    //     exit();
                    // }
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                        try {
                            $quizId = $_GET['id'];
                            $questionIds = $_POST['question_id'];
                            $userAnswers = $_POST['answer'];                            
                            $score = 0;
                            
                            // Khi user không trả lời câu nào
                            if (empty($userAnswers)) {
                                echo"<script>alert('Vui lòng chọn đáp án làm bài !');</script>";
                                echo"<script>window.history.back();</script>";
                                return false;
                            }
                            
                            // Khi user không trả lời đủ
                            if (count($questionIds) !== count($userAnswers)) {
                                echo"<script>alert('Bạn chưa chọn đủ đáp án, vui lòng làm tiếp !');</script>";
                                echo"<script>window.history.back();</script>";
                                return false;
                            }                     
                            
                            foreach ($questionIds as $questionId) {                                
                                                                
                                // Lấy đáp án đúng cho câu hỏi
                                $correctAnswers = quiz::getCorrectAnswersByQuestionId($questionId);
                                extract($correctAnswers);

                                // Lưu đáp án người dùng
                                Quiz::saveUserAnswer($userId, $questionId, $userAnswers[$question_id], $quizId);
                        
                                // Kiểm tra xem câu trả lời của người dùng có đúng không
                                if ($userAnswers[$question_id] == $answer_id) {
                                    // Tăng điểm nếu đúng
                                    $score++;
                                }

                                // update trạng thái quiz
                                Quiz::updateUserQuizStatus($userId, $quizId);
                            }

                            // Lưu điểm của người dùng
                            $totalPointId = quiz::saveUserScore($userId, $quizId, $score);
                            
                            // update trạng thái làm bài
                            

                            // Chuyen huong sang trang ket qua
                            // header("Location: ?act=check-point&quiz_id=$quizId&totalpoint_id=$totalPointId"); 
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }                 
                }
                include_once ('./views/quizes.php');
                break;
            case 'detail-blog';
                if(isset($_GET['id'])){
                    $post_id = $_GET['id']; // Bạn cần kiểm tra và xử lý tham số truyền vào từ GET ở đây
                    $total_comments = total_cmt($post_id);
                    $view= blog_view();
                    $blog = loadone_blog($_GET['id']);
    
                    }
                $listcategory = loadall_category();     
                $Blogview = loadall_post();
                include_once('./views/detailedBlog.php');
                break;
            case 'check-point':
                $userId = $_SESSION['user_id'];
                $quizId = $_GET['quiz_id'];
                $totalpointId = $_GET['totalpoint_id'];
                $result = quiz::getResultQuiz($totalpointId);
                $quiz = quiz::getQuizById($quizId);
                $questions = Quiz::getQuestionByQuizId($quizId);                
                
                include_once('./views/checkPoint.php');
                break;

            case 'reset-quiz':
                if (isset($_GET['user_id']) && isset($_GET['quiz_id'])) {
                    $userId = $_GET['user_id'];
                    $quizId = $_GET['quiz_id'];
                
                    // Xóa dữ liệu từ bảng 'user_answers' và 'totalpoints'
                    quiz::deleteUserData($userId, $quizId);
                
                    // Chuyển hướng trở lại trang làm quiz
                    header("Location: index.php?act=quiz&quiz_id=$quizId");
                }
                break;
            case 'rank':
                include_once('./views/rank.php');
                break;
            case 'login':
                include_once('./views/accounts/login.php');
                break;
            case 'register':
                include_once('./views/accounts/register.php');
                break;
            case 'forgotPassword':
                include_once('./views/accounts/forgetPassword.php');
                break;
            default:
                include_once('./home.php');
                break;
        }
    }else {
        // nothing
        include_once ('./home.php');

    }

    include_once('./footer.php');
?>