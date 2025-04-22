<?php
require_once 'commons/env.php';
require_once 'commons/function.php';

class UserModel
{
   private $conn;
   public function __construct()
   {

      $this->conn = connect_db();
   }

   public function submit_contact()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

       

        echo "<script>alert('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.'); window.location.href = '" . BASE_URL . "';</script>";
    }else{
        require_once './views/User/Contact.php';
    }
}

   public function getUserById($id)
   {
      $sql = "SELECT * FROM users WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function registerUser($name, $email, $password, $phone, $address, $avatar)
   {
      $sql = "INSERT INTO users (name, email, password, phone, address, avatar,role,status) VALUES (?, ?, ?, ?, ?, ?, 0, 'active')";
      $stmt = $this->conn->prepare($sql);
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      return $stmt->execute([$name, $email, $hashedPassword, $phone, $address, $avatar]);
   }

   public function getUserByEmail($email)
   {
      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$email]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   //Caapj nhaatj

   public function updateUser($id, $name, $email, $phone, $address, $avatar )
   {
      if (empty($email)) {
         throw new Exception("Email không được để trống.");
     }
      $sql = "UPDATE users SET name = :name, email = :email, phone = :phone, address = :address";
      if ($avatar) {
         $sql .= ", avatar = :avatar";
      }
      $sql .= " WHERE id =:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if ($avatar) {
         $stmt->bindParam(':avatar', $avatar);
      }
      return $stmt->execute();
   }


   // doi mk
   public function changePassword($id, $newPassword)
   {
      if (empty($newPassword)) {
         throw new Exception("Mật khẩu mới không được để trống.");
     }

      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $sql = "UPDATE users SET password = :password WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':password', $hashedPassword);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
   }
   //kiem tra mk hien tai

   public function verifyPassword($id, $currentPassword)
{
    $user = $this->getUserById($id);
    return $user && password_verify($currentPassword, $user['password']);
}

     // Kiểm tra email đã tồn tại
     public function isEmailExists($email)
     {
         $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute([$email]);
         return $stmt->fetchColumn() > 0;
     }
}
