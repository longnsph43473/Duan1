<?php
class Connect
{
    public $conn;

    public function __construct()
    {
        $this->conn = connect_db();
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}

class CartModel extends Connect
{
    public function get_cart($cart_id)
    {
        $sql = "SELECT 
                    cd.id, 
                    cd.cart_id, 
                    cd.product_detail_id, 
                    cd.quantity, 
                    cd.price, 
                    pd.stock,  
                    p.name AS product_name,
                    p.description,
                    p.category_id,
                    p.id AS product_id,
                    s.size_name,
                    cl.color_name,
                    cl.color_code,
                    MIN(i.image_url) AS first_image
                FROM cart_details AS cd
                JOIN product_detail AS pd ON pd.id = cd.product_detail_id  
                JOIN products AS p ON pd.product_id = p.id
                JOIN sizes AS s ON s.id = pd.size_id
                JOIN colors AS cl ON cl.id = pd.color_id
                LEFT JOIN images AS i ON p.id = i.product_id
                WHERE cd.cart_id = :cart_id
                GROUP BY cd.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":cart_id", $cart_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cart_item($cart_id, $product_detail_id)
    {
        $sql = "SELECT * FROM cart_details 
                WHERE cart_id = :cart_id AND product_detail_id = :product_detail_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':cart_id' => $cart_id,
            ':product_detail_id' => $product_detail_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_cart_detail($cart_detail_id)
    {
        $sql = "SELECT
                    cd.id as cart_detail_id,
                    cd.quantity,
                    cd.price,
                    pd.id as product_detail_id,
                    s.size_name,
                    c.color_name,
                    c.color_code,
                    p.name,
                    MIN(i.image_url) AS first_image
                FROM cart_details cd
                JOIN product_detail pd ON pd.id = cd.product_detail_id
                JOIN sizes s ON pd.size_id = s.id
                JOIN colors c ON pd.color_id = c.id
                JOIN products p ON p.id = pd.product_id
                LEFT JOIN images i ON i.product_id = p.id
                WHERE cd.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $cart_detail_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_stock_quantity($product_detail_id)
    {
        $sql = "SELECT stock FROM product_detail WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $product_detail_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result["stock"] : 0;
    }

    public function create_cart()
    {
        $sql = "INSERT INTO cart DEFAULT VALUES";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $this->conn->lastInsertId(); // trả về cart_id
    }

    public function add_cart_detail($cart_detail)
    {
        $sql = "INSERT INTO cart_details (cart_id, product_detail_id, quantity, price) 
                VALUES (:cart_id, :product_detail_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":cart_id", $cart_detail["cart_id"]);
        $stmt->bindParam(":product_detail_id", $cart_detail["product_detail_id"]);
        $stmt->bindParam(":quantity", $cart_detail["quantity"]);
        $stmt->bindParam(":price", $cart_detail["price"]);
        $stmt->execute();
    }

    public function delete_cart_detail($cart_detail_id)
    {
        $sql = "DELETE FROM cart_details WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $cart_detail_id);
        $stmt->execute();
    }

    public function update_cart_item_quantity($cart_id, $product_detail_id, $new_quantity)
    {
        $sql = "UPDATE cart_details 
                SET quantity = :quantity 
                WHERE cart_id = :cart_id AND product_detail_id = :product_detail_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':quantity' => $new_quantity,
            ':cart_id' => $cart_id,
            ':product_detail_id' => $product_detail_id
        ]);
    }
}
