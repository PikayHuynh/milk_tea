<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container-fluid text-center">
        <div class="alert alert-success">
            <h2>Đặt hàng thành công!</h2>
            <p>Mã đơn hàng: <strong>#<?php echo $order['order_id']; ?></strong></p>
            <p>Tổng tiền: <strong><?php echo number_format($order['total_amount']); ?> VND</strong></p>
            <p>Trạng thái: <strong><?php echo $order['status']; ?></strong></p>
        </div>

        <p>Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ liên hệ với bạn sớm nhất.</p>

        <a href="<?php echo BASE_URL; ?>" class="btn btn-primary">Về trang chủ</a>
    </div>
</section>

<?php
include __DIR__ . '/../template/footer.php';
?>