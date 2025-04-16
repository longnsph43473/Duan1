<?php 
class ClientProductModel{
    private $connection;

    public function getAllProduct()  {
        $query = "SELECT * FROM products";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .categories {
            text-align: center;
        }

        .category-list {
            display: flex; /* Display items in a row */
            justify-content: center; /* Center the items */
            list-style: none; /* Remove default list styles */
            padding: 0; /* Remove padding */
            margin: 0; /* Remove margin */
            gap: 20px; /* Space between items */
        }

        .category-list li {
            position: relative; /* For hover effect positioning */
            overflow: hidden; /* Prevents image overflow */
            border-radius: 10px; /* Rounded corners */
            transition: transform 0.3s ease; /* Animation effect */
        }

        .category-list li:hover {
            transform: scale(1.05); /* Slight scale on hover */
        }

        .category-list img {
            max-width: 200px; /* Set a max-width for better control */
            height: auto; /* Maintain aspect ratio */
            border-radius: 10px; /* Match the parent radius */
            transition: transform 0.3s ease; /* Animation effect */
        }

        .category-list li:hover img {
            transform: scale(1.1); /* Slight zoom on hover */
        }
    </style>
</head>
<body>

<section class="categories">
    <h2>Danh Mục Sản Phẩm</h2>
    <ul class="category-list">
        <li>
            <a href="#">
                <img src="public/images/váy/anh11.jpg" alt="Váy" />
            </a>
        </li>
        <li>
            <a href="#">
                <img src="public/images/áo phong/z6427049469666_5642f2b40d4f30e919ae96313d6b646b.jpg" alt="Áo Phông" />
            </a>
        </li>
        <li>
            <a href="#">
                <img src="public/images/quần/z6427058916226_812197864e55a002aa64164fa47ce000.jpg" alt="Quần" />
            </a>
        </li>
        <li>
            <a href="#">
                <img src="public/images/ao khoac/z6427065417228_c4d35643131b5ce9de14e98e3e4b8886.jpg" alt="Áo Khoác" />
            </a>
        </li>
    </ul>
</section>

</body>
</html>