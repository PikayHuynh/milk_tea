<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container-fluid">
        <h2 class="mb-4">Thanh toán</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <h4>Thông tin giao hàng</h4>
                <form action="<?php echo BASE_URL; ?>checkout/process" method="POST">
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ giao hàng</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-success">Đặt hàng</button>
                    <a href="<?php echo BASE_URL; ?>cart" class="btn btn-secondary">Quay lại giỏ hàng</a>
                </form>
            </div>

            <div class="col-md-4">
                <h4>Đơn hàng của bạn</h4>
                <div class="card">
                    <div class="card-body">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo htmlspecialchars($item['product_name']); ?> x
                                    <?php echo $item['quantity']; ?></span>
                                <span><?php echo number_format($item['price'] * $item['quantity']); ?> VND</span>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong><?php echo number_format($total); ?> VND</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../template/footer.php';
?>