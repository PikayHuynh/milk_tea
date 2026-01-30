<?php

namespace admin;

require_once __DIR__ . '/../controller.php';
require_once __DIR__ . '/../../entity/User.php';
require_once __DIR__ . '/../../entity/Product.php';
require_once __DIR__ . '/../../entity/Order.php';

class DashboardController extends \Controller
{
    public function index()
    {
        $this->checkAuth(['admin', 'staff']);

        $userModel = new \User();
        $productModel = new \Product();
        $orderModel = new \Order();

        // Stats
        $totalUsers = $this->countTable('user');
        $totalProducts = $this->countTable('product');
        $totalOrders = $this->countTable('order');
        $totalRevenue = $this->sumColumn('order', 'total_amount', ['status' => 'Completed']);

        // Recent Orders
        $recentOrders = $this->getRecentOrders($orderModel);

        // Recent Products
        $recentProducts = $this->getRecentProducts($productModel);

        $this->loadView('admin/dashboard/index.php', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'recentOrders' => $recentOrders,
            'recentProducts' => $recentProducts
        ]);
    }

    private function countTable($table)
    {
        global $conn;
        $stmt = $conn->query("SELECT COUNT(*) FROM `{$table}`");
        return $stmt->fetchColumn();
    }

    private function sumColumn($table, $column, $conditions = [])
    {
        global $conn;
        $sql = "SELECT SUM(`{$column}`) FROM `{$table}`";
        if (!empty($conditions)) {
            $sql .= " WHERE ";
            $clauses = [];
            foreach ($conditions as $k => $v) {
                $clauses[] = "$k = '$v'";
            }
            $sql .= implode(' AND ', $clauses);
        }
        $stmt = $conn->query($sql);
        return $stmt->fetchColumn() ?: 0;
    }

    private function getRecentOrders($orderModel)
    {
        $sql = "SELECT o.*, u.username 
                FROM `order` o 
                LEFT JOIN user u ON o.user_id = u.user_id 
                ORDER BY o.created_at DESC 
                LIMIT 5";
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getRecentProducts($productModel)
    {
        $sql = "SELECT * FROM `product` ORDER BY product_id DESC LIMIT 5";
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
