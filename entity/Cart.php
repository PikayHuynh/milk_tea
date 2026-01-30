<?php
require_once __DIR__ . '/Model.php';

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    public function getActiveCartByUserId($userId)
    {
        // Assuming cart is active if it exists for the user. 
        // We might want to clear it after order completion or have a status.
        // For now, let's just find the existing cart or create one.
        $cart = $this->findOneBy('user_id', $userId);
        if (!$cart) {
            $this->create(['user_id' => $userId]);
            $cart = $this->findOneBy('user_id', $userId);
        }
        return $cart;
    }
}
