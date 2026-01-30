<?php
namespace client;

use Cart;
use CartDetail;
use Product;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/Cart.php';
require_once __DIR__ . '/../../entity/CartDetail.php';
require_once __DIR__ . '/../../entity/Product.php';

class CartController extends \Controller
{
    private $cartModel;
    private $cartDetailModel;
    private $productModel;

    public function __construct()
    {
        $this->cartModel = new \Cart();
        $this->cartDetailModel = new \CartDetail();
        $this->productModel = new \Product();
    }

    private function getCartId()
    {
        if (isset($_SESSION['user_id'])) {
            // Logged in user: Use database cart
            $cart = $this->cartModel->findOneBy('user_id', $_SESSION['user_id']);
            if (!$cart) {
                $this->cartModel->create(['user_id' => $_SESSION['user_id']]);
                $cart = $this->cartModel->findOneBy('user_id', $_SESSION['user_id']);
            }
            return $cart['cart_id'];
        } else {
            // Guest user: Use session cart ID or create temporary one
            if (!isset($_SESSION['cart_id'])) {
                // Determine a way to handle guest carts without user_id being mandatory/unique or use session storage only.
                // For simplicity, let's enforce login for cart usage or store full cart in session.
                // Given "Basic PHP Website" prompt, maybe just store in session for guests.
                return null;
            }
            return $_SESSION['cart_id'];
        }
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            // Handle as guest cart in session
            $cartItems = $_SESSION['cart'] ?? [];
            // Need to fetch product details for these items
            $products = [];
            $total = 0;
            foreach ($cartItems as $pid => $qty) {
                $p = $this->productModel->getById($pid);
                if ($p) {
                    $p['quantity'] = $qty;
                    $p['subtotal'] = $p['price'] * $qty;
                    $total += $p['subtotal'];
                    $products[] = $p;
                }
            }
            $this->loadView('client/cart/index.php', ['cartItems' => $products, 'total' => $total]);
            return;
        }

        // Logged in user
        $cartId = $this->getCartId();
        $items = $this->cartDetailModel->getAll(['cart_id' => $cartId]);

        // Enrich items with product info
        $cartItems = [];
        $total = 0;
        foreach ($items as $item) {
            $p = $this->productModel->getById($item['product_id']);
            if ($p) {
                $p['quantity'] = $item['quantity'];
                $p['cart_detail_id'] = $item['cart_detail_id'];
                $p['subtotal'] = $p['price'] * $item['quantity'];
                $total += $p['subtotal'];
                $cartItems[] = $p;
            }
        }

        $this->loadView('client/cart/index.php', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function add()
    {
        $productId = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;

        if (!$productId) {
            $this->redirect('/');
            return;
        }

        if (!isset($_SESSION['user_id'])) {
            // Guest: Add to Session
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
            $_SESSION['success'] = 'Đã thêm vào giỏ hàng!';
            $this->redirect($_SERVER['HTTP_REFERER'] ?? '/');
            return;
        }

        // Logged in
        $cartId = $this->getCartId();

        // Check if item exists in cart
        $existingItem = $this->cartDetailModel->getAll([
            'cart_id' => $cartId,
            'product_id' => $productId
        ]);

        if (!empty($existingItem)) {
            $item = $existingItem[0];
            $newQty = $item['quantity'] + $quantity;
            $this->cartDetailModel->update($item['cart_detail_id'], ['quantity' => $newQty]);
        } else {
            $this->cartDetailModel->create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        $_SESSION['success'] = 'Đã thêm vào giỏ hàng!';
        $this->redirect($_SERVER['HTTP_REFERER'] ?? '/');
    }

    public function update()
    {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if ($quantity <= 0) {
            // Redirect to remove instead of calling method
            $this->redirect('/cart/remove?id=' . $productId);
            return;
        }

        if (!isset($_SESSION['user_id'])) {
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] = $quantity;
            }
        } else {
            $cartId = $this->getCartId();
            // Find cart detail correctly
            // Since we don't have composite key lookup easily in model, do a search
            $existingItem = $this->cartDetailModel->getAll([
                'cart_id' => $cartId,
                'product_id' => $productId
            ]);

            if (!empty($existingItem)) {
                $this->cartDetailModel->update($existingItem[0]['cart_detail_id'], ['quantity' => $quantity]);
            }
        }
        $this->redirect('/cart');
    }

    public function remove()
    {
        $productId = $_GET['id'] ?? null;
        if (!$productId) {
            $this->redirect('/cart');
            return;
        }

        if (!isset($_SESSION['user_id'])) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $cartId = $this->getCartId();
            $existingItem = $this->cartDetailModel->getAll([
                'cart_id' => $cartId,
                'product_id' => $productId
            ]);
            if (!empty($existingItem)) {
                $this->cartDetailModel->delete($existingItem[0]['cart_detail_id']);
            }
        }
        $this->redirect('/cart');
    }
}
