<?php

namespace client;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/User.php';
require_once __DIR__ . '/../../entity/Order.php';

class ProfileController extends \Controller
{
    private $userModel;
    private $orderModel;

    public function __construct()
    {
        // Only logged in users can access profile
        if (!isset($_SESSION['user_id'])) {
            $this->redirect($this->getBaseUrl() . '/login');
            exit();
        }
        $this->userModel = new \User();
        $this->orderModel = new \Order();
    }

    /**
     * Show customer profile
     */
    public function index()
    {
        $user = $this->userModel->getById($_SESSION['user_id']);
        if (!$user) {
            $this->redirect($this->getBaseUrl() . '/logout');
            exit();
        }

        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);

        $this->loadView('client/auth/profile.php', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    /**
     * Update customer profile
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->getBaseUrl() . '/profile');
            return;
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);

        $data = [
            'username' => $_POST['username'] ?? $user['username'],
            'email' => $_POST['email'] ?? $user['email'],
            'phone' => $_POST['phone'] ?? $user['phone'],
        ];

        // Validate
        if (empty($data['username']) || empty($data['email'])) {
            $_SESSION['error'] = 'Username và Email không được để trống';
            $this->redirect($this->getBaseUrl() . '/profile');
            return;
        }

        // Handle avatar upload
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/images/avatars/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $extension;
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                // Delete old avatar if not default
                if (isset($user['avatar']) && $user['avatar'] !== 'user.png' && !empty($user['avatar'])) {
                    $oldFile = $uploadDir . $user['avatar'];
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                $data['avatar'] = $fileName;
                $_SESSION['avatar'] = $fileName; // Sync session
            }
        }

        // Handle password update if provided
        if (!empty($_POST['new_password'])) {
            if ($_POST['new_password'] !== $_POST['confirm_password']) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp';
                $this->redirect($this->getBaseUrl() . '/profile');
                return;
            }
            $data['password'] = $_POST['new_password'];
        }

        if ($this->userModel->update($userId, $data)) {
            $_SESSION['username'] = $data['username']; // Sync session
            $_SESSION['success'] = 'Cập nhật thông tin thành công!';
        } else {
            $_SESSION['error'] = 'Đã có lỗi xảy ra khi cập nhật';
        }

        $this->redirect($this->getBaseUrl() . '/profile');
    }
}
