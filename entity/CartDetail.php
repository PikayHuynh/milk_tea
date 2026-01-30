<?php
require_once __DIR__ . '/Model.php';

class CartDetail extends Model
{
    protected $table = 'cart_detail';
    protected $primaryKey = 'cart_detail_id';

    public function getItemsByCartId($cartId)
    {
        $sql = "SELECT cd.*, p.product_name, p.price, p.image_url 
                FROM {$this->table} cd 
                JOIN product p ON cd.product_id = p.product_id 
                WHERE cd.cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cart_id' => $cartId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateQuantity($cartId, $productId, $quantity)
    {
        // Check if item exists in cart
        $sql = "SELECT * FROM {$this->table} WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cart_id' => $cartId, ':product_id' => $productId]);
        $item = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($item) {
            if ($quantity <= 0) {
                // Remove item if quantity is 0 or less
                return $this->delete($item['cart_detail_id']);
            } else {
                // Update quantity
                return $this->update($item['cart_detail_id'], ['quantity' => $quantity]);
            }
        } else {
            if ($quantity > 0) {
                // Add new item
                return $this->create([
                    'cart_id' => $cartId,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
        }
        return false;
    }
}
