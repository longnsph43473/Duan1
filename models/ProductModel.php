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


class ProductModel extends Connect
{
    public $conn;
    // CRUD Product
    public function get_list()
    {
        $sql = "SELECT 
                        p.id, 
                        p.category_id, 
                        p.name, 
                        p.description, 
                        p.price, 
                        p.quantity, 
                        GROUP_CONCAT(i.image_url SEPARATOR ', ') AS images
                    FROM products AS p
                    LEFT JOIN images AS i ON p.id = i.product_id
                    GROUP BY p.id";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_product_detail($product_id)
    {
        $sql = "SELECT 
            p.id AS product_id,
            p.name AS product_name,
            p.description,
            p.price,
            p.quantity,
            c.category_name,
            s.size_name,
            col.color_name,
            col.color_code,
            pd.stock,
            i.image_url
        FROM Product_Detail pd
        JOIN Products p ON pd.product_id = p.id
        JOIN Categories c ON p.category_id = c.id
        JOIN Sizes s ON pd.size_id = s.id
        JOIN Colors col ON pd.color_id = col.id
        LEFT JOIN Images i ON p.id = i.product_id
        WHERE p.id = :product_id";
        $data = $this->conn->prepare($sql);
        $data->bindParam(":product_id", $product_id);
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC); 
    }
}

class CategoryModel extends Connect
{
    public function get_list()
    {
        $sql = "SELECT * FROM categories";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_category_id($id)
    {
        if ($this->conn) {
            $sql = "SELECT * from categories WHERE id = :id";
            $data = $this->conn->prepare($sql);
            $data->bindParam(":id", $id);
            $data->execute();
            return $data->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}