<?php
class ProductModel extends Connect
{

  
  
public function search_products($keyword)
{
    $sql = "SELECT
                p.id,
                p.name,
                p.description,
                p.price,
                CONCAT('" . BASE_URL . "public/images/', MIN(i.image_url)) AS first_image
            FROM products AS p
            LEFT JOIN images AS i ON p.id = i.product_id
            WHERE p.name LIKE :keyword OR p.description LIKE :keyword
            GROUP BY p.id, p.name, p.description, p.price";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
        public function get_product()
    {
        $sql = "SELECT 
                        p.id, 
                        p.name, 
                        p.description, 
                        p.price, 
                        p.quantity, 
                        c.category_name,
                        MIN(i.image_url) AS first_image
                    FROM products AS p
                    JOIN categories AS c ON c.id = p.category_id
                    LEFT JOIN images AS i ON p.id = i.product_id
                    GROUP BY p.id, c.category_name";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

}