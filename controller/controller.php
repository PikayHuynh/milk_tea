<?php

// Include config
require_once __DIR__ . '/../database/config.php';

// Include database connection
require_once __DIR__ . '/../database/connect.php';

class Controller {

    public function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($script);
        
        if (strpos($basePath, '/milk_tea') !== false) {
            $basePath = '/milk_tea';
        } else {
            $basePath = '';
        }
        
        return $protocol . '://' . $host . $basePath;
    }
    
    public function loadView($viewPath, $data = []) {
        extract($data);
        
        $baseUrl = $this->getBaseUrl();
        
        $viewFile = __DIR__ . '/../view/' . $viewPath;
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Không tìm thấy file view: " . $viewPath);
        }
    }
    
    public function redirect($url) {
        header("Location: " . $url);
        exit();
    }
}