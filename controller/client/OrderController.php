<?php

namespace client;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/Order.php';
require_once __DIR__ . '/../../entity/OrderDetail.php';

class OrderController extends \Controller
{
    private $orderModel;
    private $orderDetailModel;

    public function __construct()
    {
        // Only logged in users can access orders
        if (!isset($_SESSION['user_id'])) {
            $this->redirect($this->getBaseUrl() . '/login');
            exit();
        }
        $this->orderModel = new \Order();
        $this->orderDetailModel = new \OrderDetail();
    }

    /**
     * List customer orders
     */
    public function index()
    {
        $userId = $_SESSION['user_id'];
        $orders = $this->orderModel->getOrdersByUserId($userId);

        $this->loadView('client/order/list.php', ['orders' => $orders]);
    }

    /**
     * Show order details
     */
    public function detail()
    {
        $orderId = $_GET['id'] ?? null;
        $userId = $_SESSION['user_id'];

        if (!$orderId) {
            $this->redirect($this->getBaseUrl() . '/orders');
            return;
        }

        $order = $this->orderModel->getById($orderId);

        // Security check: ensure the order belongs to the logged-in user
        if (!$order || $order['user_id'] != $userId) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng hoặc bạn không có quyền xem.';
            $this->redirect($this->getBaseUrl() . '/orders');
            return;
        }

        $orderDetails = $this->orderDetailModel->getItemsByOrderId($orderId);

        $this->loadView('client/order/detail.php', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);
    }
}
