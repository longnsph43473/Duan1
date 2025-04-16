<!-- filepath: c:\laragon\www\Project\Project_1\views\register.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Ký</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-box {
      background: white;
      padding: 30px;
      border-radius: 6px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      width: 400px;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 6px;
      color: #555;
    }
    input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .btn {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #ee4d2d;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .message {
      margin-top: 15px;
      font-size: 14px;
      color: red;
    }
    .login-link {
      margin-top: 10px;
      text-align: center;
      font-size: 14px;
    }
    .login-link a {
      color: #0056b3;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Đăng Ký</h2>
    <?php if (isset($message)): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST" action="index.php?act=register">
      <div class="form-group">
        <label>Họ và tên:</label>
        <input type="text" name="name" required>
      </div>
      <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
      </div>
      <div class="form-group">
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label>Số điện thoại:</label>
        <input type="text" name="phone">
      </div>
      <div class="form-group">
        <label>Địa chỉ:</label>
        <input type="text" name="address">
      </div>
      <button type="submit" class="btn">Đăng Ký</button>
    </form>
    <div class="login-link">
      Đã có tài khoản? <a href="index.php?act=login">Đăng nhập</a>
    </div>
  </div>
</body>
</html>