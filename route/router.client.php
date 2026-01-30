<?php

class RouterClient {
    public static function addURL($router) {
        $router->addRoute('', 'client\HomeController', 'index');
    }
}