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
    public function get_table($table_name, $conditions = [], $columns = "*", $limit = null)
    {
        $sql = "SELECT $columns FROM $table_name";
        $params = [];

        if (!empty($conditions)) {
            $sql .= " WHERE ";
            $whereClauses = [];

            foreach ($conditions as $column => $value) {
                $whereClauses[] = "$column = :$column";
                $params[":$column"] = $value;
            }

            $sql .= implode(" AND ", $whereClauses);
        }

        if ($limit) {
            $sql .= " LIMIT :limit";
        }

        $data = $this->conn->prepare($sql);

        foreach ($params as $param => $value) {
            $data->bindValue($param, $value);
        }

        if ($limit) {
            $data->bindValue(":limit", $limit, PDO::PARAM_INT);
        }

        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

}

class ProductModel {

    private function get_db_connection() {
        return connect_db(); 
    }


    public function get_product() {
        $conn = $this->get_db_connection();  
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết sản phẩm theo ID
    public function get_product_detail($product_id) {
        $conn = $this->get_db_connection();  // Lấy kết nối
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục sản phẩm
    public function get_table($table) {
        $conn = $this->get_db_connection();  // Lấy kết nối
        $stmt = $conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy số lượng sản phẩm trong giỏ hàng
    public function get_quantity_product_cart($user_id) {
        $conn = $this->get_db_connection();
        $stmt = $conn->prepare("SELECT SUM(quantity) AS total_quantity FROM cart_details WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_quantity'];
    }
}
