<?php

// Include config
require_once __DIR__ . '/../database/config.php';

// Include database connection
require_once __DIR__ . '/../database/connect.php';

class Controller
{

    public function getBaseUrl()
    {
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

    public function loadView($viewPath, $data = [])
    {
        extract($data);

        $baseUrl = $this->getBaseUrl();

        $viewFile = __DIR__ . '/../view/' . $viewPath;

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Không tìm thấy file view: " . $viewPath);
        }
    }

    public function redirect($url)
    {
        $baseUrl = $this->getBaseUrl();
        // If url doesn't start with http, prepend base url
        if (strpos($url, 'http') !== 0) {
            // Ensure url starts with / if not present
            if (strpos($url, '/') !== 0) {
                $url = '/' . $url;
            }
            // But getBaseUrl likely returns http://host/milk_tea
            // If url is /login -> http://host/milk_tea/login

            // Check if BaseUrl already ends with / to avoid double slash if url starts with /
            // implementation of getBaseUrl in line 23 doesn't end with /

            header("Location: " . $baseUrl . $url);
        } else {
            header("Location: " . $url);
        }
        exit();
    }

    /**
     * Check authentication and authorization
     * @param array $allowedRoles List of allowed role names. If empty, just check if logged in.
     */
    public function checkAuth($allowedRoles = [])
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        if (!empty($allowedRoles)) {
            $currentRole = $_SESSION['role_name'] ?? '';
            // Case insensitive check
            $allowedRoles = array_map('strtolower', $allowedRoles);
            if (!in_array(strtolower($currentRole), $allowedRoles)) {
                // Not authorized
                http_response_code(403);
                die("Bạn không có quyền truy cập trang này! <a href='" . $this->getBaseUrl() . "'>Về trang chủ</a>");
            }
        }
    }
}