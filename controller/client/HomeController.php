<?php

namespace client;

require_once __DIR__ . '/../controller.php';

class HomeController extends \Controller {
    public function index() {
        $this->loadView('client/home/index.php');
    }
}
