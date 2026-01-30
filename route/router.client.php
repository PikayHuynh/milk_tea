<?php

class RouterClient
{
    public static function addURL($router)
    {
        $router->addRoute('', 'client\HomeController', 'index');

        $router->addRoute('product-detail', 'client\HomeController', 'productDetail');

        // Profile routes
        $router->addRoute('profile', 'client\ProfileController', 'index');
        $router->addRoute('profile/update', 'client\ProfileController', 'update');

        // Order history routes
        $router->addRoute('orders', 'client\OrderController', 'index');
        $router->addRoute('orders/detail', 'client\OrderController', 'detail');

        // Cart routes
        $router->addRoute('cart', 'client\CartController', 'index');
        $router->addRoute('cart/add', 'client\CartController', 'add');
        $router->addRoute('cart/update', 'client\CartController', 'update');
        $router->addRoute('cart/remove', 'client\CartController', 'remove');

        // Checkout routes
        $router->addRoute('checkout', 'client\CheckoutController', 'index');
        $router->addRoute('checkout/process', 'client\CheckoutController', 'process');
        $router->addRoute('checkout/success', 'client\CheckoutController', 'success');
    }
}