<?php

namespace admin;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/Product.php';
require_once __DIR__ . '/../../entity/Category.php';

class ProductController extends \Controller
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        // Only Admin/Staff can access Product Management
        $this->checkAuth(['admin', 'staff']);
        $this->productModel = new \Product();
        $this->categoryModel = new \Category();
    }

    public function listProducts()
    {
        $products = $this->productModel->getAll();

        // Optionally fetch category names if not already capable via join or if we want to display it properly
        // Assuming getAll returns raw table data

        $this->loadView('admin/product/list.php', ['products' => $products]);
    }

    public function addProduct()
    {
        $categories = $this->categoryModel->getAll();
        $this->loadView('admin/product/add.php', ['categories' => $categories]);
    }

    public function createProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->getBaseUrl() . '/admin/add-product');
            return;
        }

        $data = [
            'product_name' => $_POST['product_name'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'description' => $_POST['description'] ?? '',
            'category_id' => $_POST['category_id'] ?? null,
            'stock_quantity' => $_POST['stock_quantity'] ?? 0,
            'image_url' => 'default.png' // Default image
        ];

        // Handle Image Upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/images/';
            // Ensure directory exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $data['image_url'] = $fileName;
            }
        }

        if ($this->productModel->create($data)) {
            $_SESSION['success'] = 'Product created successfully';
            $this->redirect($this->getBaseUrl() . '/admin/products');
        } else {
            $_SESSION['error'] = 'Failed to create product';
            $this->redirect($this->getBaseUrl() . '/admin/add-product');
        }
    }

    public function editProduct()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect($this->getBaseUrl() . '/admin/products');
        }

        $product = $this->productModel->getById($id);
        if (!$product) {
            $_SESSION['error'] = 'Product not found';
            $this->redirect($this->getBaseUrl() . '/admin/products');
        }

        $categories = $this->categoryModel->getAll();
        $this->loadView('admin/product/edit.php', ['product' => $product, 'categories' => $categories]);
    }

    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->getBaseUrl() . '/admin/products');
            return;
        }

        $id = $_POST['product_id'];
        $product = $this->productModel->getById($id);

        $data = [
            'product_name' => $_POST['product_name'] ?? $product['product_name'],
            'price' => $_POST['price'] ?? $product['price'],
            'description' => $_POST['description'] ?? $product['description'],
            'category_id' => $_POST['category_id'] ?? $product['category_id'],
            'stock_quantity' => $_POST['stock_quantity'] ?? $product['stock_quantity'],
        ];

        // Handle Image Upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/images/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $data['image_url'] = $fileName;
            }
        }

        if ($this->productModel->update($id, $data)) {
            $_SESSION['success'] = 'Product updated successfully';
            $this->redirect($this->getBaseUrl() . '/admin/products');
        } else {
            $_SESSION['error'] = 'Failed to update product';
            $this->redirect($this->getBaseUrl() . '/admin/edit-product?id=' . $id);
        }
    }

    public function deleteProduct()
    {
        $id = $_GET['id'] ?? null;
        if ($id && $this->productModel->delete($id)) {
            $_SESSION['success'] = 'Product deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete product';
        }
        $this->redirect($this->getBaseUrl() . '/admin/products');
    }
}
