<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ease - Thời Trang Hiện Đại</title>
  <link rel="stylesheet" href="./assets/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">



</head>
<style>
  /* Reset CSS */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  body {
    background-color: #f7f7f7;
    color: #333;
    line-height: 1.6;
  }

  /* Header */
  /* Reset CSS */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  body {
    background-color: #f7f7f7;
    color: #333;
    line-height: 1.6;
  }

  /* Header */
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 40px;
    background-color: #fff;
    border-bottom: 1px solid #ccc;
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .logo {
    font-size: 40px;
    font-weight: bold;
    color: #e91e1e;
    text-decoration: none;
  }

  nav ul {
    display: flex;
    list-style: none;
  }

  nav ul li {
    margin-left: 30px;
  }

  nav a {
    text-decoration: none;
    color: #333;
    font-size: 18px;
    transition: color 0.3s;
  }

  nav a:hover {
    color: #e91e63;
  }

  /* Header Icons */
  .header-icons {
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .header-icons a {
    text-decoration: none;
    color: #000;
    font-size: 16px;
    transition: color 0.3s;
  }

  .header-icons a:hover {
    color: #e91e63;
  }

 
  /* Dropdown Menu */
  .dropdown-menu {
    z-index: 1000;
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    
  }

  .dropdown-menu.show {
    display: block;
  }

  .dropdown-menu a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s;
  }

  .dropdown-menu a:hover {
    background-color: #f1f1f1;
    color: #e91e63;
  }

  /* Search Container */
  .search-container {
    display: flex;
    align-items: center;
    background-color: #fdf7f7;
    border-radius: 30px;
    padding: 8px 12px;
    width: 500px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .search-container input {
    border: none;
    background-color: transparent;
    outline: none;
    flex: 1;
    font-size: 16px;
    color: #666;
  }

  .search-container input::placeholder {
    color: #aaa;
  }

  .search-container button {
    background-color: #ff6240;
    border: none;
    color: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .search-container button:hover {
    background-color: #ff473d;
  }

  /* Banner */
  .banner {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
  }

  .slide {
    width: 100%;
    height: 100%;
    position: absolute;
    opacity: 0;
    transition: opacity 1s ease-in-out;
  }

  .slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .slide.active {
    opacity: 1;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    header {
      flex-direction: column;
      align-items: flex-start;
      padding: 20px;
    }

    .search-container {
      width: 100%;
      margin-top: 10px;
    }

    nav ul {
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    nav ul li {
      margin-left: 0;
    }

    .header-icons {
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }
  }

  @media (max-width: 480px) {
    .logo {
      font-size: 30px;
    }

    nav a {
      font-size: 16px;
    }

    .search-container {
      padding: 6px 10px;
    }

    .search-container input {
      font-size: 14px;
    }

    .search-container button {
      width: 35px;
      height: 35px;
    }
  }
</style>

<body>
  <!-- Header -->
  <header>
    <div class="logo">Ease</div>
    <div class="search-container">
      <input type="text" placeholder="Tìm kiếm..." />
      <button class="search-btn">🔍</button>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Trang Chủ</a></li>
        <li><a href="#">Nam</a></li>
        <li><a href="#">Nữ</a></li>
        <li><a href="news.html">Tin Tức</a></li>
        <li><a href="<?php echo BASE_URL . "?act=submit_contact" ?>">Liên Hệ</a></li>
      </ul>
    </nav>
    <div class="header-icons">
  <a href="index.php?act=cart">🛒 Giỏ Hàng</a>
  <?php if (isset($_SESSION['id'])): ?>
    <div class="account-menu">
      <a href="#" class="account-icon">
        <i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['name']) ?>
      </a>
      <div class="dropdown-menu">
        <a href="index.php?act=profile"><i class="fas fa-user-circle"></i> Tài khoản</a>
        <a href="index.php?act=profile"><i class="fas fa-address-card"></i> Hồ sơ</a>
        <a href="index.php?act=logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
      </div>
    </div>
  <?php else: ?>
    <a href="index.php?act=login" class="account-icon">
      <i class="fas fa-user-circle"></i> Đăng nhập
    </a>
  <?php endif; ?>
</div>

  </header>

  <!-- Banner Slide -->
  <section class="banner">
    <!-- <div class="slide active"> <img src="img/bander/banner1.jpg" alt="Banner 1" /> </div> -->
    <div class="slide"> <img src="assets/img/bander/baner2.jpg" alt="Banner 2" /> </div>
    <div class="slide"> <img src="assets/img/bander/baner3.jpg" alt="Banner 3" /> </div>
  </section>

  <script>
    document.querySelectorAll('.account-icon').forEach(icon => {
      icon.addEventListener('click', function(e) {
        const dropdown = this.nextElementSibling; // Lấy dropdown menu liên quan
        dropdown.classList.toggle('show'); // Thêm/xóa class 'show'
        e.stopPropagation(); // Ngăn chặn sự kiện lan ra ngoài
      });
    });

    // Đóng dropdown nếu nhấp ra ngoài
    document.addEventListener('click', function() {
      document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.classList.remove('show');
      });
    });
  </script>