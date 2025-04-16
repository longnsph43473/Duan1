<?php 
class CartModel{
    public function __construct(){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
    }

    public function addToCart($product)  {
        $productId = $product['id'];
        if(isset($_SESSION['cart'][$productId])){
            $_SESSION['cart'][$productId]['quantity'] +=1;

        }else{
            $product['quantity'] = 1;
            $_SESSION['cart'][$productId] = $product;
        }
        
    }

    public function getItems()  {
        return $_SESSION['cart'];
    }

    public function removeCart($productId)  {
        if(isset($_SESSION['cart'][$productId])){
            unset($_SESSION['cart'][$productId]);
        }
    }

    public function getTotalPrice()  {
        $totalPrice = 0;
        foreach($_SESSION['cart'] as $item){
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return $totalPrice;
    }
}

?>