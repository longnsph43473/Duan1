<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng - EASE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="bg-danger text-white py-1">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="#" class="text-white text-decoration-none me-3">Kênh Người Bán</a>
                <a href="#" class="text-white text-decoration-none me-3">Tải ứng dụng</a>
                <a href="#" class="text-white text-decoration-none">Kết nối</a>
                <i class="bi bi-facebook ms-2"></i>
                <i class="bi bi-instagram ms-2"></i>
            </div>
            <div class="d-flex align-items-center">
                <a href="#" class="text-white text-decoration-none me-3"><i class="bi bi-bell"></i> Thông Báo</a>
                <a href="#" class="text-white text-decoration-none me-3"><i class="bi bi-question-circle"></i> Hỗ Trợ</a>
                <a href="#" class="text-white text-decoration-none me-3"><i class="bi bi-globe"></i> Tiếng Việt</a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i> Tài khoản
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Tài khoản của tôi</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-cart me-2"></i>Đơn mua</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">EASE - SHOP</a>
           
                <form class="d-flex ms-auto">
                    <input class="form-control me-2" type="search" placeholder="Tìm sản phẩm...">
                    <button class="btn btn-danger" type="submit">Tìm</button>
                </form>
            
        </div>
    </nav>
    <div class="container mt-4">
        <h3>Giỏ Hàng</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Số tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <img src="product.jpg" width="50" alt="Sản phẩm">
                       
                    </td>
                    <td></td>
                    <td>
                        <button class="btn btn-light">-</button>
                        <input type="text" value="1" size="1">
                        <button class="btn btn-light">+</button>
                    </td>
                    <td></td>
                    <td><button class="btn btn-danger">Xóa</button></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div>
                <input type="checkbox"> Chọn tất cả (1)
                <button class="btn btn-secondary">Xóa</button>
            </div>
            <div>
                <span>Tổng cộng: <strong></strong></span>
                <button class="btn btn-danger">Mua Hàng</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
