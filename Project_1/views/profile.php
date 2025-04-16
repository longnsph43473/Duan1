<?php

require_once 'commons/env.php';
require_once 'commons/function.php';
require_once 'controllers/HomeController.php';
require_once 'models/UserModel.php';


//tạm set 
if (!isset($_SESSION['id'])) {
  $_SESSION['id'] = 1;
}
// Kiểm tra người dùng đã đăng nhập chưa
// if (!isset($_SESSION['id'])) {
//     header('Location: login.php');
//     exit();
// }

$userModel = new UserModel();
$userId = $_SESSION['id'] ?? null;
$user = null;

// Xử lý cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  if (empty($email)) {
    die("Email không được để trống.");
}

  $phone = $_POST['phone'] ?? '';
  $address = $_POST['address'] ?? '';
  $avatar = $user['avatar'] ?? 'img/default.png';

  // Xử lý upload avatar nếu có
  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
    $avatar = 'img/' . time() . '_' . $_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'], './assets/' . $avatar);
  }

  if ($userModel->updateUser($userId, $name, $email, $phone, $address, $avatar)) {
    $message = "Cập nhật thông tin thành công!";
    $user = $userModel->getUserById($userId); 
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['phone'] = $user['phone'];
    $_SESSION['address'] = $user['address'];
    $_SESSION['avatar'] = $user['avatar'];
  } else {
    $message = "Cập nhật thông tin thất bại!";
  }
}

// Xử lý đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
  $currentPassword = $_POST['current_password'];
  $newPassword = $_POST['new_password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($newPassword !== $confirmPassword) {
    $passwordMessage = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
  } elseif (!$userModel->verifyPassword($userId, $currentPassword)) {
    $passwordMessage = "Mật khẩu hiện tại không đúng!";
  } else {
    if ($userModel->changePassword($userId, $newPassword)) {
      $passwordMessage = "Đổi mật khẩu thành công!";
    } else {
      $passwordMessage = "Đổi mật khẩu thất bại!";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hồ Sơ Của Tôi</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      margin: 0;
      background: #f5f5f5;
    }

    .container {
      max-width: 1200px;
      margin: 40px auto;
      display: flex;
      background: #fff;
      border-radius: 4px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sidebar {
      width: 250px;
      border-right: 1px solid #eee;
      padding: 20px;
    }

    .sidebar img {
      border-radius: 50%;
      width: 60px;
      height: 60px;
    }

    .username {
      font-weight: bold;
      margin-top: 10px;
    }

    .menu {
      margin-top: 30px;
    }

    .menu-item {
      margin: 10px 0;
      color: #555;
      cursor: pointer;
    }

    .menu-item.active {
      color: #ee4d2d;
      font-weight: bold;
    }

    .content {
      flex: 1;
      padding: 30px 40px;
    }

    .content h2 {
      margin-bottom: 5px;
    }

    .form-group {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    .form-group label {
      width: 120px;
      color: #555;
    }

    .form-group input[type="text"],
    .form-group input[type="email"] {
      padding: 8px;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group .change-link {
      color: #05a;
      margin-left: 10px;
      font-size: 14px;
      cursor: pointer;
    }

    .gender-options input {
      margin-left: 20px;
    }

    .avatar-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-left: 50px;
    }

    .avatar-section img {
      border-radius: 50%;
      width: 100px;
      height: 100px;
      margin-bottom: 10px;
    }

    .btn {
      padding: 10px 20px;
      background: #ee4d2d;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .note {
      font-size: 13px;
      color: #999;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="sidebar">
      <img src="../assets/<?= htmlspecialchars($_SESSION['avatar'] ?? 'img/default.png') ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 10px;">
      <div class="username"><?= htmlspecialchars($_SESSION['name'] ?? 'Người dùng') ?></div>
      <div class="menu">
        <div class="menu-item">Tài Khoản Của Tôi</div>
        <div class="menu-item active">Hồ Sơ</div>
        <div class="menu-item"><a href="index.php?act=changepass">Đổi Mật Khẩu</a></div>
      </div>
    </div>

    <div class="content">
      <h2>Hồ Sơ Của Tôi</h2>
      <?php if (!empty($message)) : ?>
        <p style="color: green;"><?= $message ?></p>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="update_profile" value="1" />

        <div style="display: flex;">
          <div style="flex: 1;">
            <div class="form-group">
              <label>Tên</label>
              <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" readonly>
            </div>

            <div class="form-group">
              <label>Số điện thoại</label>
              <input type="text" name="phone" value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>">
            </div>

            <div class="form-group">
              <label>Địa chỉ</label>
              <input type="text" name="address" value="<?= htmlspecialchars($_SESSION['address'] ?? '') ?>">
            </div>

            <button class="btn" type="submit">Lưu</button>
          </div>

          <div class="avatar-section">
            <img src="../assets/<?= htmlspecialchars($_SESSION['avatar'] ?? 'img/default.png') ?>" alt="Avatar">
            <input type="file" name="avatar" accept=".png,.jpg,.jpeg">
            <p class="note">Dung lượng tối đa 1MB. Định dạng: .JPG, .PNG</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>