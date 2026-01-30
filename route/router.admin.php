<?php

class RouterAdmin
{
    public static function addURL($router)
    {
        // Admin dashboard
        $router->addRoute('admin', 'admin\DashboardController', 'index');

        // User management routes
        $router->addRoute('admin/users', 'admin\UserController', 'listUsers');
        $router->addRoute('admin/show-user', 'admin\UserController', 'userDetails');
        $router->addRoute('admin/add-user', 'admin\UserController', 'addUser');
        $router->addRoute('admin/create-user', 'admin\UserController', 'createUser');
        $router->addRoute('admin/edit-user', 'admin\UserController', 'editUser');
        $router->addRoute('admin/update-user', 'admin\UserController', 'updateUser');
        $router->addRoute('admin/delete-user', 'admin\UserController', 'deleteUser');

        // Product management routes
        $router->addRoute('admin/products', 'admin\ProductController', 'listProducts');
        $router->addRoute('admin/add-product', 'admin\ProductController', 'addProduct');
        $router->addRoute('admin/create-product', 'admin\ProductController', 'createProduct');
        $router->addRoute('admin/edit-product', 'admin\ProductController', 'editProduct');
        $router->addRoute('admin/update-product', 'admin\ProductController', 'updateProduct');
        $router->addRoute('admin/delete-product', 'admin\ProductController', 'deleteProduct');

        // Order management routes
        $router->addRoute('admin/orders', 'admin\OrderController', 'index');
        $router->addRoute('admin/show-order', 'admin\OrderController', 'show');
        $router->addRoute('admin/update-order-status', 'admin\OrderController', 'updateStatus');





        // // Factory management routes
        // $router->addRoute('admin/factories', 'admin\FactoryController', 'listFactories');
        // $router->addRoute('admin/add-factory', 'admin\FactoryController', 'addFactory');
        // $router->addRoute('admin/create-factory', 'admin\FactoryController', 'createFactory');
        // $router->addRoute('admin/edit-factory', 'admin\FactoryController', 'editFactory');
        // $router->addRoute('admin/update-factory', 'admin\FactoryController', 'updateFactory');
        // $router->addRoute('admin/delete-factory', 'admin\FactoryController', 'deleteFactory');
    }
}