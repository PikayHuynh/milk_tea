<?php
$DB['host'] = 'localhost';
$DB['dbname'] = 'milk_tea_shop';
$DB['username'] = 'root';
$DB['password'] = '';
$DB['charset'] = 'utf8mb4';

try {
    $dsn = "mysql:host={$DB['host']};dbname={$DB['dbname']};charset={$DB['charset']}";
    $DB['conn'] = new PDO($dsn, $DB['username'], $DB['password']);
    $DB['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$conn = $DB['conn'];

// Tự động khởi tạo dữ liệu hệ thống (Roles, Admin, Avatar column)
require_once __DIR__ . '/init_helper.php';
auto_init_database($conn);
