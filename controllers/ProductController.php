<?php
  class ProductController{
    public $productModel;
    public function __construct(){
        $this->productModel = new ProductModel();
        // session_start();
    }
    

    //2 
    public function Product_Detail(){
      if(isset($_GET["id"])){ 
          $id = $_GET["id"]; 
          $product = $this->productModel->get_product_detail($id); // get_product_detail: lấy thông tin  chi tiết sản phẩm trong productModel
          require "./views/ProductDetail.php"; // sau khi lấy thông tin chi tiết sản phẩm -> hiển thị qua view
          
      } else{
          return false;
      }
    }
    // 2
  }

?>