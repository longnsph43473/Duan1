<?php
class UserController
{
    public $userModel;

    public $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        session_start();
    }

    public function home_view()
    {
        $products = $this->productModel->get_product();
        // require './views/html/home_page.php';
    }

    // Cart
    public function cart_view()
    {
        if (isset($_SESSION["user"]["id"])) {
            $carts = $this->userModel->get_cart($_SESSION["user"]["id"]);

            require_once "./views/User/Cart.php";
        } else {
            echo "<script>
                            alert('Bạn chưa đăng nhập nên không xem được giỏ hàng!');
                            window.location.href = '" . BASE_URL . "?act=login_view';
                        </script>";

        }

    }
    public function add_to_cart()
    {
        if (!isset($_SESSION["user"])) {
            echo "<script>alert('Bạn cần đăng nhập để thêm vào giỏ hàng!'); window.location.href='" . BASE_URL . "?act=login_view';</script>";
            return;
        }

        if (isset($_POST["product_detail_id"]) && isset($_POST["quantity"]) && isset($_POST["price"])) {
            $user_id = $_SESSION["user"]["id"];
            $product_detail_id = $_POST["product_detail_id"];
            $quantity = (int) $_POST["quantity"];
            $price = $_POST["price"];

            // Lấy số lượng tồn kho
            $stock_quantity = $this->userModel->get_stock_quantity($product_detail_id);
            if ($stock_quantity === null) {
                echo "<script>alert('Không tìm thấy thông tin sản phẩm!'); window.history.back();</script>";
                return;
            }

            // Kiểm tra giỏ hàng đã tồn tại chưa
            $cart_id = $this->userModel->get_cart_id_by_user($user_id);
            if (!$cart_id) {
                $cart_id = $this->userModel->create_cart($user_id);
            }

            // Kiểm tra sản phẩm đã có trong giỏ chưa
            $existing_item = $this->userModel->get_cart_item($cart_id, $product_detail_id);
            $current_quantity_in_cart = $existing_item ? $existing_item["quantity"] : 0;

            // Tổng số lượng sau khi thêm
            $total_quantity_after_add = $current_quantity_in_cart + $quantity;


            if ($total_quantity_after_add > $stock_quantity) {
                echo "<script>alert('❌ Số lượng bạn thêm vượt quá số lượng tồn kho!'); window.history.back();</script>";

                return;
            }

            // Nếu hợp lệ, tiến hành thêm hoặc cập nhật
            if ($existing_item) {
                $this->userModel->update_cart_item_quantity($cart_id, $product_detail_id, $total_quantity_after_add);
            } else {
                $this->userModel->add_cart_detail([
                    "cart_id" => $cart_id,
                    "product_detail_id" => $product_detail_id,
                    "quantity" => $quantity,
                    "price" => $price
                ]);
            }
            echo "<script>alert('✅ Đã thêm vào giỏ hàng!'); window.location.href = '" . BASE_URL . "?act=cart_view';</script>";
        } else {
            echo "<script>alert('❌ Thiếu thông tin sản phẩm để thêm vào giỏ hàng!'); window.history.back();</script>";
        }
    }


    public function delete_cart()
    {
        if (!isset($_SESSION["user"])) {
            echo "<script>alert('Bạn cần đăng nhập để thực hiện thao tác này!'); window.location.href='" . BASE_URL . "?act=login_view';</script>";
            return;
        }

        if (isset($_GET["cart_detail_id"])) {
            $cart_detail_id = $_GET["cart_detail_id"];
            $this->userModel->delete_cart_detail($cart_detail_id);
            echo "<script>alert('✅ Đã xóa sản phẩm khỏi giỏ hàng!'); window.location.href='" . BASE_URL . "?act=cart_view';</script>";
        } else {
            echo "<script>alert('❌ Không tìm thấy sản phẩm cần xóa!'); window.location.href='" . BASE_URL . "?act=cart_view';</script>";
        }
    }



    public function __destruct()
    {
        $this->productModel = null;
    }
}