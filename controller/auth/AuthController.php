<?php

namespace auth;

class AuthController extends \Controller
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role_name'] === 'User') {
                $this->redirect('/');
            } else {
                $this->redirect('/admin');
            }
        }
        $this->loadView('auth/login.php');
    }

    public function doLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $identifier = $_POST['identifier'] ?? '';
        $password = $_POST['password'] ?? '';

        require_once __DIR__ . '/../../entity/User.php';
        $userModel = new \User();

        $user = $userModel->verifyUser($identifier, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['role_name'] = $user['role_name'];
            if (isset($user['avatar'])) {
                $_SESSION['avatar'] = $user['avatar'];
            }

            // Redirect based on role
            if ($user['role_name'] === 'User') {
                $this->redirect('/');
            } else {
                // Admin or Staff
                $this->redirect('/admin');
            }
        } else {
            $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng!';
            $this->redirect('/login');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/login');
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }
        $this->loadView('auth/register.php');
    }

    public function doRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            $_SESSION['error'] = 'Mật khẩu xác nhận không khớp!';
            $this->redirect('/register');
        }

        require_once __DIR__ . '/../../entity/User.php';
        $userModel = new \User();

        // Check if user exists
        if ($userModel->getByEmail($email) || $userModel->findOneBy('username', $username)) {
            $_SESSION['error'] = 'Username hoặc Email đã tồn tại!';
            $this->redirect('/register');
        }

        // Create user (role_id 3 = User)
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => 3
        ];

        if ($userModel->create($data)) {
            $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
            $this->redirect('/login');
        } else {
            $_SESSION['error'] = 'Đã có lỗi xảy ra!';
            $this->redirect('/register');
        }
    }
}
