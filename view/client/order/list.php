<?php
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="bg-white p-5 rounded-5 shadow-sm border">
                    <h2 class="display-6 fw-bold mb-4">Lịch sử mua hàng</h2>

                    <?php if (empty($orders)): ?>
                        <div class="text-center py-5">
                            <div class="mb-4 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                    class="bi bi-box-seam" viewBox="0 0 16 16">
                                    <path
                                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.747l-1.358.543V10.298l1.358-.543V4.286zm-1.453 6.13l1.453.581.547-.219V4.287L14.047 3.9l-1.5 1.125v6.236zm-4.407 1.5l1.453.581.547-.219V5.112L10.047 4.7l-1.5 1.125v6.526zm-4.407 1.5l1.453.581.547-.219V5.937L5.647 5.5l-1.5 1.125v6.816zm-4.407 1.5l1.453.581.547-.219V6.762L1.247 6.3l-1.5 1.125v7.106z" />
                                </svg>
                            </div>
                            <h3>Bạn chưa có đơn hàng nào.</h3>
                            <p class="text-muted">Đặt ngay ly trà sữa thơm ngon để bắt đầu lịch sử mua hàng nhé!</p>
                            <a href="<?php echo BASE_URL; ?>" class="btn btn-primary rounded-pill px-4 mt-3">Mua sắm
                                ngay</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive mt-4">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3">Mã đơn hàng</th>
                                        <th class="py-3">Ngày đặt</th>
                                        <th class="py-3">Tổng tiền</th>
                                        <th class="py-3">Trạng thái</th>
                                        <th class="py-3 text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td class="fw-bold">#<?php echo $order['order_id']; ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                            <td class="text-primary fw-bold">
                                                <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>₫</td>
                                            <td>
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
                                                    class="badge <?php echo $statusClass; ?> rounded-pill px-3 py-2"><?php echo $statusText; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo BASE_URL; ?>orders/detail?id=<?php echo $order['order_id']; ?>"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                    Chi tiết
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <div class="mt-5 text-center">
                        <a href="<?php echo BASE_URL; ?>" class="btn btn-link text-muted">Quay lại trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../template/footer.php';
?>