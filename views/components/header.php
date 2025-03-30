<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ease - Thời Trang Hiện Đại</title>

  <link rel="stylesheet" href="<?php echo BASE_URL . "public/fonts/fonts.css" ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . "public/fonts/font-icons.css" ?>">
  <!-- css -->
  <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/bootstrap.min.css" ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/swiper-bundle.min.css" ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/animate.css" ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . "public/css/styles.css" ?>">

  <!-- Favicon and Touch Icons  -->
  <link rel="shortcut icon" href="<?php echo BASE_URL . "public/images/logo/favicon.png" ?>">
</head>

<body>
<div id="wrapper">
  <header id="header" class="header-default">
      <div class="container">
          <div class="row wrapper-header align-items-center">
              <div class="col-md-4 col-3 d-xl-none">
                  <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                      <i class="icon icon-categories1"></i>
                  </a>
              </div>
              <div class="col-xl-2 col-md-4 col-6">
                  <a href="index-2.html" class="logo-header">
                      <img src="<?php echo BASE_URL . "public/images/logo/logoEase.png" ?>" alt="logo" class="logo">
                  </a>
              </div>
              <div class="col-xl-8 d-none d-xl-block">
                  <nav class="box-navigation text-center">
                      <ul class="box-nav-menu">
                          <li class="menu-item">
                              <a href="#" class="item-link">Trang chủ<i class="icon icon-arr-down"></i></a>
                          </li>
                          <li class="menu-item">
                              <a href="#" class="item-link">Nam<i class="icon icon-arr-down"></i></a>
                              <div class="sub-menu mega-menu mega-shop">
                                  <div class="wrapper-sub-menu">
                                      <div class="mega-menu-item">
                                          <div class="menu-heading">
                                             <a href="#" class="item-link">Nam</a>
                                          </div>
                                          <!-- <ul class="menu-list">
                                              <li><a href="shop-default.html"
                                                      class="menu-link-text link">Default</a></li>
                                              <li><a href="shop-left-sidebar.html"
                                                      class="menu-link-text link">Filter Left Sidebar</a></li>
                                          </ul> -->
                                      </div>
                                      <div class="mega-menu-item">
                                          <div class="menu-heading">
                                             <a href="#" class="item-link">Nữ</a>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </li>
                          <li class="menu-item">
                              <a href="#" class="item-link">Nữ<i class="icon icon-arr-down"></i></a>
                              <div class="sub-menu mega-menu mega-product">
                                  <div class="wrapper-sub-menu">
                                      <div class="mega-menu-item">
                                          <div class="menu-heading">
                                            <a href="#" class="item-link">Váy</a>
                                          </div>
                                          <!-- <ul class="menu-list">
                                              <li><a href="product-detail.html"
                                                      class="menu-link-text link">Product Single</a></li>
                                              <li><a href="product-right-thumbnail.html"
                                                      class="menu-link-text link">Product Right Thumbnail</a></li>
                                              <li><a href="product-detail.html"
                                                      class="menu-link-text link">Product Left Thumbnail</a></li>
                                              <li><a href="product-bottom-thumbnail.html"
                                                      class="menu-link-text link">Product Bottom Thumbnail</a>
                                              </li>
                                              <li><a href="product-grid.html" class="menu-link-text link">Product
                                                      Grid</a></li>
                                              <li><a href="product-grid-02.html"
                                                      class="menu-link-text link">Product Grid 2</a></li>
                                              <li><a href="product-stacked.html"
                                                      class="menu-link-text link">Product Stacked</a></li>
                                              <li><a href="product-drawer-sidebar.html"
                                                      class="menu-link-text link">Product Drawer Sidebar</a></li>
                                          </ul> -->
                                      </div>
                                      <div class="mega-menu-item">
                                          <div class="menu-heading">
                                            <a href="#" class="item-link">Áo</a>
                                          </div>
                                      </div>
                                      <div class="mega-menu-item">
                                          <div class="menu-heading">
                                            <a href="#" class="item-link">Quần</a>
                                          </div>
                                      </div>
                                      <div class="mega-menu-item">
                                          <div class="menu-heading">
                                            <a href="#" class="item-link">Áo khoác</a>
                                          </div>
                                      </div>
                                  </div>
                                  
                              </div>
                          </li>
                          <li class="menu-item position-relative">
                              <a href="#" class="item-link">Liên hệ<i class="icon icon-arr-down"></i></a>
                              
                          </li>
                          
                      </ul>
                  </nav>
              </div>
              <div class="col-xl-2 col-md-4 col-3">
                  <ul class="nav-icon d-flex justify-content-end align-items-center">
                      <li class="nav-search">
                          <a href="#search" data-bs-toggle="offcanvas" class="nav-icon-item">
                              <i class="icon icon-search"></i>
                          </a>
                      </li>
                      <li class="nav-account"> 
                          <!-- đăng nhập đăng ký -->
                          <a href="#login" data-bs-toggle="offcanvas" aria-controls="login" class="nav-icon-item">
                              <i class="icon icon-user"></i>
                          </a>
                      </li>
                      <li class="nav-cart">
                            <!-- giỏ hàng -->
                          <a href="#shoppingCart" data-bs-toggle="offcanvas" class="nav-icon-item">
                              <i class="icon icon-cart"></i>
                              <span class="count-box">0</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </header>

  
</div>


</body>

</html>