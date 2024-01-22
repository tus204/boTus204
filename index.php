<?php
session_start();
ob_start();
include './vendor/autoload.php';
// // index
// header("Location: /VietNamHistory/client/");

use Controllers\AuthController;
use Core\Database;
use Views\Accounts\LoginView;
use Views\Accounts\RegisterView;
use Views\HeaderUser;
use Views\HomeUser;
use Views\QuizView;

$db = new Database();
$login = new AuthController();

$header = new HeaderUser();
$header->headerUserRender();

if(isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'login':
        $loginView = new LoginView();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $login->loginUser($email, $password);
        } else {
            $loginView->loginReder();
        }
        break;

        case 'logout':
            $login->logoutUser();
        break;

        case 'register':            
            $login->registerUser();
            
        break;

        case 'quiz':
            $quizView = new QuizView();
            $quizView->quizRender();
        break;
    } 
} else {
    // nothing
    $viewHome = new HomeUser();
    $viewHome->homeUserRender();
}
?>


