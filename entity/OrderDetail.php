<?php
require_once __DIR__ . '/Model.php';

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'order_detail_id';

    public function getItemsByOrderId($orderId)
    {
        $sql = "SELECT od.*, p.product_name, p.price, p.image_url 
                FROM {$this->table} od 
                JOIN product p ON od.product_id = p.product_id 
                WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
