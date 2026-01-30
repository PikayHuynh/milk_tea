<?php

namespace admin;

require_once __DIR__ . '/../controller.php';

class DashboardController extends \Controller {
    public function index() {
        $this->loadView('admin/dashboard/index.php');
    }
}
