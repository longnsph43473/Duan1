<?php
// ProductController.php
class ProductController {
    public $productModel;

    public function __construct(){
        $this->productModel = new ProductModel();
        session_start();
    }

    // Hiển thị trang chủ với danh sách sản phẩm
    public function home_view(){
        $_SESSION["products"] = $this->productModel->get_product();
        if (isset($_SESSION["user"]["id"])) {
            $user_id = $_SESSION["user"]["id"];
            $_SESSION["user"]["cart"] = $this->productModel->get_quantity_product_cart($user_id);
        }
        require './views/HomePage.php';
    }

    // Hiển thị các danh mục sản phẩm
    public function product_view(){
        $category = $this->productModel->get_table("categories");
        require_once './views/Category.php';
    }

    // Hiển thị chi tiết sản phẩm
    public function product_detail_view(){
        if (isset($_GET["product_id"])) {
            $product_detail = $this->productModel->get_product_detail($_GET["product_id"]);
            require_once './views/ProductDetail.php';
        }
    }

    public function __destruct(){
        $this->productModel = null;
    }
}

?>
