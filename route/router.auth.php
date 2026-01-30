<?php

class RouterAuth
{
    public static function addURL($router)
    {
        // Login
        $router->addRoute('login', 'auth\AuthController', 'login');
        $router->addRoute('auth/login', 'auth\AuthController', 'doLogin');

        // Logout
        $router->addRoute('logout', 'auth\AuthController', 'logout');

        // Register
        $router->addRoute('register', 'auth\AuthController', 'register');
        $router->addRoute('auth/register', 'auth\AuthController', 'doRegister');
    }
}
