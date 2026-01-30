<?php
namespace client;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/Cart.php';
require_once __DIR__ . '/../../entity/CartDetail.php';
require_once __DIR__ . '/../../entity/Order.php';
require_once __DIR__ . '/../../entity/OrderDetail.php';
require_once __DIR__ . '/../../entity/Product.php';

class CheckoutController extends \Controller
{
    private $cartModel;
    private $cartDetailModel;
    private $orderModel;
    private $orderDetailModel;
    private $productModel;

    public function __construct()
    {
        $this->checkAuth(['user']); // Only logged-in users can checkout
        $this->cartModel = new \Cart();
        $this->cartDetailModel = new \CartDetail();
        $this->orderModel = new \Order();
        $this->orderDetailModel = new \OrderDetail();
        $this->productModel = new \Product();
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $cart = $this->cartModel->findOneBy('user_id', $userId);

        if (!$cart) {
            $_SESSION['error'] = 'Giỏ hàng trống!';
            $this->redirect('/cart');
            return;
        }

        $cartItems = $this->cartDetailModel->getItemsByCartId($cart['cart_id']);

        if (empty($cartItems)) {
            $_SESSION['error'] = 'Giỏ hàng trống!';
            $this->redirect('/cart');
            return;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->loadView('client/checkout/index.php', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/checkout');
            return;
        }

        $userId = $_SESSION['user_id'];
        $address = $_POST['address'] ?? '';
        $phone = $_POST['phone'] ?? '';

        if (empty($address) || empty($phone)) {
            $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin!';
            $this->redirect('/checkout');
            return;
        }

        // Get cart
        $cart = $this->cartModel->findOneBy('user_id', $userId);
        if (!$cart) {
            $_SESSION['error'] = 'Giỏ hàng trống!';
            $this->redirect('/cart');
            return;
        }

        $cartItems = $this->cartDetailModel->getItemsByCartId($cart['cart_id']);
        if (empty($cartItems)) {
            $_SESSION['error'] = 'Giỏ hàng trống!';
            $this->redirect('/cart');
            return;
        }

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $orderId = $this->orderModel->create([
            'user_id' => $userId,
            'total_amount' => $total,
            'status' => 'Pending',
            'shipping_address' => $address,
            'phone' => $phone
        ]);

        if (!$orderId) {
            $_SESSION['error'] = 'Đặt hàng thất bại!';
            $this->redirect('/checkout');
            return;
        }

        // Move cart items to order details
        foreach ($cartItems as $item) {
            $this->orderDetailModel->create([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // Clear cart
        $this->cartDetailModel->deleteAll($cartItems);
        $this->cartModel->delete($cart['cart_id']);

        $_SESSION['success'] = 'Đặt hàng thành công!';
        $this->redirect('/checkout/success?order_id=' . $orderId);
    }

    public function success()
    {
        $orderId = $_GET['order_id'] ?? null;
        if (!$orderId) {
            $this->redirect('/');
            return;
        }

        $order = $this->orderModel->getById($orderId);
        if (!$order || $order['user_id'] != $_SESSION['user_id']) {
            $this->redirect('/');
            return;
        }

        $this->loadView('client/checkout/success.php', ['order' => $order]);
    }
}
