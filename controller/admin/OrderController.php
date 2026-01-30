<?php
namespace admin;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/Order.php';
require_once __DIR__ . '/../../entity/OrderDetail.php';
require_once __DIR__ . '/../../entity/User.php';

class OrderController extends \Controller
{
    private $orderModel;
    private $orderDetailModel;
    private $userModel;

    public function __construct()
    {
        $this->checkAuth(['admin', 'staff']);
        $this->orderModel = new \Order();
        $this->orderDetailModel = new \OrderDetail();
        $this->userModel = new \User();
    }

    public function index()
    {
        $orders = $this->orderModel->getOrdersWithUserInfo();
        $this->loadView('admin/order/list.php', ['orders' => $orders]);
    }

    public function show()
    {
        $orderId = $_GET['id'] ?? null;
        if (!$orderId) {
            $this->redirect('/admin/orders');
            return;
        }

        $order = $this->orderModel->getById($orderId);
        if (!$order) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng!';
            $this->redirect('/admin/orders');
            return;
        }

        $user = $this->userModel->getById($order['user_id']);
        $orderItems = $this->orderDetailModel->getItemsByOrderId($orderId);

        $this->loadView('admin/order/show.php', [
            'order' => $order,
            'user' => $user,
            'orderItems' => $orderItems
        ]);
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/orders');
            return;
        }

        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? '';

        if (!$orderId || !$status) {
            $_SESSION['error'] = 'Dữ liệu không hợp lệ!';
            $this->redirect('/admin/orders');
            return;
        }

        if ($this->orderModel->update($orderId, ['status' => $status])) {
            $_SESSION['success'] = 'Cập nhật trạng thái thành công!';
        } else {
            $_SESSION['error'] = 'Cập nhật thất bại!';
        }

        $this->redirect('/admin/show-order?id=' . $orderId);
    }
}
