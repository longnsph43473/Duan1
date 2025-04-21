<?php

require_once 'models/UserModel.php';
class HomeController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    //profile

    public function showUserProfile()
    {
        if (!isset($_SESSION['id'])) {
            header("Location:index.php?act=login");
            exit();
            // echo "Bạn chưa đăng nhập";
            // return;
        }

        $id = $_SESSION['id'];
        $user = $this->userModel->getUserById($id);
        // $message = $_GET['message'] ?? '';
        if ($user) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['avatar'] = $user['avatar'];
            require_once 'views/profile.php';
        } else {
            echo "User not found";
        }
    }
    public function product_view(){
        $category = $this->productModel->get_table("categories");
        require_once './views/Category.php';
    }

    public function updateUserProfile()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $name = $_POST['name']?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            $user = $this->userModel->getUserById($id);
            $email = $_POST['email'] ?? $_SESSION['email'] ?? '';
            if (empty($email)) {
                die("Email không được để trống.");
            } 
            $avatar = $user['avatar']; 
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $avatarUpload = $this->handleAvatarUpload($_FILES['avatar']);
                if ($avatarUpload) {
                    $avatar = $avatarUpload;
                }
            }

            $result = $this->userModel->updateUser($id, $name, $email, $phone, $address, $avatar);
            if ($result) {
                $_SESSION['name'] = $name;
                $_SESSION['phone'] = $phone;
                $_SESSION['address'] = $address;
                $_SESSION['avatar'] = $avatar;
                header("Location: index.php?act=profile&message=Cập nhật thành công!");
                exit();
            } else {
                header("Location: index.php?act=profile&message=Cập nhật thất bại!");
                exit();
            }
        }
    }


    public function changePassword()
    {
        $userModel = new UserModel();
        $userId = $_SESSION['id'] ?? null;

        if (!$userId) {
            header("Location: index.php?act=login");
            exit();
        }
    
        $passwordMessage = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $passwordMessage = "Vui lòng điền đầy đủ thông tin!";
            } elseif ($newPassword !== $confirmPassword) {
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
        require_once 'views/changepass.php';
    }


    public function handleAvatarUpload($file)
    {
        $uploadDir = '../assets/img/'; // Thư mục lưu ảnh
        $fileName = uniqid() . '-' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $fileName; // Trả về tên file để lưu vào database
        }
        return null;
    }

    public function register()  {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
           
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'] ?? null;
            $address = $_POST['address'] ?? null;
          
            $avatar = 'default.png'; 
            //kiem tra email da otn ton tai
            if ($this->userModel->getUserByEmail(($email))) {
               $message = "Email đã được sử dụng";
               require_once 'views/register.php';
               return;
            }
//Them ngưƠi dung moi
            
            if ($this->userModel->registerUser($name,$email,$password,$phone,$address,$avatar)) {
                header("Location: index.php?act=login&message=Đăng kí thành công!");
                exit();
            } else {
               $message = "Đăng kí thất bại";
            }
        }
        require_once 'views/register.php';
    }


    public function login()  {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
           
            $email = $_POST['email'];
            $password = $_POST['password'];
          $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
               $_SESSION['id'] = $user['id'];
               $_SESSION['name'] = $user['name'];
               $_SESSION['email'] = $user['email'];
               $_SESSION['phone'] = $user['phone'];
               $_SESSION['address'] = $user['address'];
               $_SESSION['avatar'] = $user['avatar'];
               header("Location: index.php");
               exit();
            }else{
                $message = "Email hoặc mật khẩu không đúng";
            }
            
        }
        require_once 'views/login.php';
    }

    public function logout(){
        session_destroy();
        header("Location: index.php?act=login");
    }


    public function home()
    {


        require_once './views/home.php';
    }
}
