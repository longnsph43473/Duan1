<?php


require_once './commons/env.php'; 
require_once './commons/function.php'; 



require_once "./controllers/HomeController.php";
require_once "./controllers/ProductController.php";

require_once "./models/ProductModel.php";




// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match




match ($act) {
    // Trang chủ
    '/' => (new ProductController())->home_view(),

    // Product
    'pd' => (new ProductController())->product_detail_view(),
    'category' => (new ProductController())->product_view(),

    default => require_once './views/components/404.php', // Trang lỗi 404
};

// include('./views/components/footer.php');