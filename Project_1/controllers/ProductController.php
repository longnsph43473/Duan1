<?php
    class ProductController{
        public $userModel;

        public $productModel;
        public $commentModel;

        public function __construct(){
            $this->productModel = new ProductModel();
            $this->userModel = new UserModel();
         

            session_start();
        }

        public function home_view(){
            $_SESSION["products"] = $this->productModel->get_product();
            if(isset($_SESSION["user"]["id"])){
                $user_id = $_SESSION["user"]["id"];
                $_SESSION["user"]["cart"] = $this->productModel->get_quantity_product_cart($user_id);
            }
            require './views/home.php';
        }

       
        public function search_product()
        {
            if (isset($_GET["keyword"])) {
                $keyword = htmlspecialchars($_GET["keyword"], ENT_QUOTES, 'UTF-8');
                $products = $this->productModel->search_products($keyword);
        
            
        
                require './views/SearchResults.php';
            } else {
                echo "<script>alert('Vui lòng nhập từ khóa tìm kiếm!'); window.history.back();</script>";
            }
        }

       
       
       
       
       
    }