<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once "./controllers/HomeController.php";
require_once "./controllers/ProductController.php";

// Require toàn bộ file Models
require_once "./models/ProductModel.php";


include('./views/components/header.php');


// 1
// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
    'product_detail' => (new ProductController())->Product_Detail(), // 2

};
//1

include('./views/components/footer.php');



