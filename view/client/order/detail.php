<?php
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="bg-white p-5 rounded-5 shadow-sm border">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="display-6 fw-bold m-0">Chi tiết đơn hàng #<?php echo $order['order_id']; ?></h2>
                        <span class="fs-5">
                            Ngày đặt: <strong><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></strong>
                        </span>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-4 h-100">
                                <h5 class="fw-bold mb-3">Thông tin giao hàng</h5>
                                <p class="mb-2"><strong>Người nhận:</strong>
                                    <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                                <p class="mb-2"><strong>Số điện thoại:</strong>
                                    <?php echo htmlspecialchars($order['phone']); ?></p>
                                <p class="mb-0"><strong>Địa chỉ:</strong>
                                    <?php echo htmlspecialchars($order['shipping_address']); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-4 h-100 text-md-end">
                                <h5 class="fw-bold mb-3">Trạng thái đơn hàng</h5>
                                <?php
                                $statusClass = 'bg-secondary';
                                $statusText = $order['status'];
                                if ($order['status'] == 'Pending') {
                                    $statusClass = 'bg-warning text-dark';
                                    $statusText = 'Đang chờ';
                                } elseif ($order['status'] == 'Processing') {
                                    $statusClass = 'bg-info text-dark';
                                    $statusText = 'Đang xử lý';
                                } elseif ($order['status'] == 'Shipped') {
                                    $statusClass = 'bg-primary';
                                    $statusText = 'Đang giao';
                                } elseif ($order['status'] == 'Completed') {
                                    $statusClass = 'bg-success';
                                    $statusText = 'Hoàn thành';
                                } elseif ($order['status'] == 'Cancelled') {
                                    $statusClass = 'bg-danger';
                                    $statusText = 'Đã hủy';
                                }
                                ?>
                                <span
                                    class="fs-4 badge <?php echo $statusClass; ?> rounded-pill px-4 py-2 mb-3 d-inline-block"><?php echo $statusText; ?></span>
                                <p class="mb-0 text-muted">Tổng thành toán:</p>
                                <h3 class="text-primary fw-bold">
                                    <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>₫
                                </h3>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4">Danh sách sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderDetails as $item): ?>
                                    <tr>
                                        <td style="width: 80px;">
                                            <img src="<?php echo get_product_image_url($item['image_url']); ?>"
                                                alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                                                class="rounded-3 shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <span
                                                class="fw-bold text-dark"><?php echo htmlspecialchars($item['product_name']); ?></span><br>
                                            <small class="text-muted">Milk Tea House</small>
                                        </td>
                                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</td>
                                        <td class="text-center">x<?php echo $item['quantity']; ?></td>
                                        <td class="text-end fw-bold">
                                            <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>₫
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end fw-bold py-3">Tổng cộng:</td>
                                    <td class="text-end text-primary fw-bold py-3 fs-5">
                                        <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>₫
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-5 d-flex justify-content-between">
                        <a href="<?php echo BASE_URL; ?>orders" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fa fa-arrow-left me-2"></i> Quay lại danh sách
                        </a>
                        <a href="<?php echo BASE_URL; ?>" class="btn btn-primary rounded-pill px-4">
                            Mua sắm thêm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../template/footer.php';
?>