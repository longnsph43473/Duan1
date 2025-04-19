<?php 
session_start();


// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once "./controllers/HomeController.php";

require_once "./models/UserModel.php";
// Require toàn bộ file Models


// Route
$act = $_GET['act'] ?? '/';
$controllers = new HomeController();

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
   
   'profile' =>( new HomeController())->showUserProfile(),

    // Cập nhật thông tin người dùng
    'update-profile' =>(new HomeController())->updateUserProfile(),

    // Đổi mật khẩu
    'changepass' => (new HomeController())->changePassword(),
    'register' => (new HomeController())->register(),
    'login' => (new HomeController())->login(),
    'logout' => (new HomeController())->logout(),
   
    default => (function() {
        http_response_code(404);
        require_once 'views/404.php'; // Load view 404 nếu có
    })(),
    
};


