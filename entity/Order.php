<?php
require_once __DIR__ . '/Model.php';

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';

    public function getOrdersWithUserInfo()
    {
        $sql = "SELECT o.*, u.username, u.email 
                FROM `{$this->table}` o 
                LEFT JOIN user u ON o.user_id = u.user_id 
                ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
