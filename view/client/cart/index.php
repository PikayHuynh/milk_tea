<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container-fluid">
        <h2 class="mb-4">Giỏ hàng của bạn</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (!empty($cartItems)): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo get_product_image_url($item['image_url']); ?>"
                                        alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo number_format($item['price']); ?> VND</td>
                                <td>
                                    <form action="<?php echo BASE_URL; ?>cart/update" method="POST" class="d-inline">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1"
                                            style="width: 70px;" class="form-control d-inline">
                                        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                    </form>
                                </td>
                                <td><?php echo number_format($item['subtotal']); ?> VND</td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>cart/remove?id=<?php echo $item['product_id']; ?>"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td colspan="2"><strong><?php echo number_format($total); ?> VND</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4">
                <a href="<?php echo BASE_URL; ?>" class="btn btn-secondary">Tiếp tục mua hàng</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>checkout" class="btn btn-success float-end">Thanh toán</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>login" class="btn btn-success float-end">Đăng nhập để thanh toán</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Giỏ hàng trống. <a href="<?php echo BASE_URL; ?>">Tiếp tục mua hàng</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
include __DIR__ . '/../template/footer.php';
?>