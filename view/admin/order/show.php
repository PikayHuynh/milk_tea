<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6 class="mb-4">Chi tiết đơn hàng #<?php echo $order['order_id']; ?></h6>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Thông tin khách hàng</h6>
                <p><strong>Tên:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>SĐT:</strong> <?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order['shipping_address'] ?? 'N/A'); ?></p>
            </div>
            <div class="col-md-6">
                <h6>Thông tin đơn hàng</h6>
                <p><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount']); ?> VND</p>
                <p><strong>Trạng thái:</strong>
                    <span class="badge <?php
                    echo $order['status'] == 'Pending' ? 'bg-warning' :
                        ($order['status'] == 'Processing' ? 'bg-info' :
                            ($order['status'] == 'Completed' ? 'bg-success' : 'bg-danger'));
                    ?>">
                        <?php echo $order['status']; ?>
                    </span>
                </p>
            </div>
        </div>

        <h6>Sản phẩm</h6>
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td>
                                <img src="<?php echo get_product_image_url($item['image_url']); ?>" alt=""
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo number_format($item['price']); ?> VND</td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item['price'] * $item['quantity']); ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h6>Cập nhật trạng thái</h6>
        <form action="<?php echo BASE_URL; ?>admin/update-order-status" method="POST" class="mb-3">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
            <div class="row">
                <div class="col-md-4">
                    <select name="status" class="form-select" required>
                        <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending
                        </option>
                        <option value="Processing" <?php echo $order['status'] == 'Processing' ? 'selected' : ''; ?>>
                            Processing</option>
                        <option value="Completed" <?php echo $order['status'] == 'Completed' ? 'selected' : ''; ?>>
                            Completed</option>
                        <option value="Cancelled" <?php echo $order['status'] == 'Cancelled' ? 'selected' : ''; ?>>
                            Cancelled</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>

        <a href="<?php echo BASE_URL; ?>admin/orders" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<?php
include __DIR__ . '/../template/footer.php';
?>