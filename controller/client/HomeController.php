<?php

namespace client;

require_once __DIR__ . '/../controller.php';

class HomeController extends \Controller
{
    public function index()
    {
        require_once __DIR__ . '/../../entity/Product.php';
        $productModel = new \Product();
        $products = $productModel->getAll();

        $this->loadView('client/home/index.php', ['products' => $products]);
    }

    public function productDetail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(BASE_URL);
            return;
        }

        require_once __DIR__ . '/../../entity/Product.php';
        $productModel = new \Product();
        $product = $productModel->getById($id);

        if (!$product) {
            $this->redirect(BASE_URL);
            return;
        }

        $this->loadView('client/home/detail.php', ['product' => $product]);
    }
}
