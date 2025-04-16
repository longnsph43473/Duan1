<!-- views/changepass.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đổi Mật Khẩu</title>
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
      color: green;
    }

    .error {
      color: red;
    }

    .back-link {
      display: block;
      margin-top: 10px;
      text-align: center;
      font-size: 14px;
      color: #0056b3;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Đổi Mật Khẩu</h2>

    <?php if (isset($passwordMessage)): ?>
      <div class="message <?= strpos($passwordMessage, 'thành công') !== false ? '' : 'error' ?>">
        <?= $passwordMessage ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="index.php?act=changepass">
      
      <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?? '' ?>">

      <div class="form-group">
        <label>Mật khẩu hiện tại:</label>
        <input type="password" name="current_password" required>
      </div>

      <div class="form-group">
        <label>Mật khẩu mới:</label>
        <input type="password" name="new_password" required>
      </div>

      <div class="form-group">
        <label>Xác nhận mật khẩu mới:</label>
        <input type="password" name="confirm_password" required>
      </div>

      <button type="submit" name="change_password" class="btn">Cập nhật mật khẩu</button>
    </form>

    <a href="index.php?act=profile" class="back-link">← Quay lại hồ sơ</a>
  </div>
</body>
</html>
