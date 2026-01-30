<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div
                class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-0 transition-hover">
                <i class="fa fa-shopping-cart fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold">Tổng đơn hàng</p>
                    <h4 class="mb-0 fw-bold"><?php echo number_format($totalOrders); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div
                class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-0 transition-hover">
                <i class="fa fa-mug-hot fa-3x text-success"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold">Tổng sản phẩm</p>
                    <h4 class="mb-0 fw-bold"><?php echo number_format($totalProducts); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div
                class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-0 transition-hover">
                <i class="fa fa-users fa-3x text-info"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold">Thành viên</p>
                    <h4 class="mb-0 fw-bold"><?php echo number_format($totalUsers); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div
                class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm border-0 transition-hover">
                <i class="fa fa-money-bill-wave fa-3x text-danger"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2 text-muted fw-bold">Doanh thu (VNĐ)</p>
                    <h4 class="mb-0 fw-bold text-danger"><?php echo number_format($totalRevenue, 0, ',', '.'); ?>đ</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Recent Transactions & Products Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light text-center rounded p-4 shadow-sm border-0 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 fw-bold"><i class="fa fa-history me-2 text-primary"></i>Đơn hàng gần đây</h6>
                    <a href="<?php echo BASE_URL; ?>admin/orders" class="btn btn-sm btn-link">Xem tất cả</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Mã đơn</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Số tiền</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentOrders)): ?>
                                <?php foreach ($recentOrders as $order): ?>
                                    <tr>
                                        <td class="fw-bold">#<?php echo $order['order_id']; ?></td>
                                        <td><?php echo htmlspecialchars($order['username'] ?? 'Khách'); ?></td>
                                        <td class="text-danger fw-bold">
                                            <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>đ
                                        </td>
                                        <td>
                                            <?php
                                            $statusClass = 'bg-warning';
                                            switch ($order['status']) {
                                                case 'Completed':
                                                    $statusClass = 'bg-success';
                                                    break;
                                                case 'Cancelled':
                                                    $statusClass = 'bg-danger';
                                                    break;
                                                case 'Shipped':
                                                    $statusClass = 'bg-info';
                                                    break;
                                            }
                                            ?>
                                            <span class="badge <?php echo $statusClass; ?> rounded-pill px-2"
                                                style="font-size: 0.75rem;"><?php echo $order['status']; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Chưa có đơn hàng nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Latest Products -->
        <div class="col-sm-12 col-xl-4">
            <div class="bg-light rounded p-4 shadow-sm border-0 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 fw-bold"><i class="fa fa-mug-hot me-2 text-success"></i>Sản phẩm mới</h6>
                    <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-sm btn-link">Xem tất cả</a>
                </div>
                <?php if (!empty($recentProducts)): ?>
                    <?php foreach ($recentProducts as $product): ?>
                        <div class="d-flex align-items-center border-bottom py-3 transition-hover">
                            <img class="rounded flex-shrink-0" src="<?php echo get_product_image_url($product['image_url']); ?>"
                                alt="" style="width: 45px; height: 45px; object-fit: cover;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0 text-truncate" style="max-width: 150px;">
                                        <?php echo htmlspecialchars($product['product_name']); ?>
                                    </h6>
                                    <small
                                        class="text-primary fw-bold"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</small>
                                </div>
                                <small class="text-muted">ID: #<?php echo $product['product_id']; ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted py-5">Chưa có sản phẩm nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- System Info Start -->
<div class="container-fluid pt-4 px-4 mb-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6">
            <div class="h-100 bg-light rounded p-4 shadow-sm border-0">
                <h6 class="mb-4 fw-bold"><i class="fa fa-calendar-alt me-2 text-info"></i>Lịch biểu</h6>
                <div id="calender"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="h-100 bg-light rounded p-4 shadow-sm border-0">
                <h6 class="mb-4 fw-bold"><i class="fa fa-info-circle me-2 text-warning"></i>Thông tin hệ thống</h6>
                <div class="d-flex align-items-center border-bottom py-3">
                    <div class="w-100">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Phiên bản PHP</h6>
                            <span class="badge bg-primary rounded-pill"><?php echo PHP_VERSION; ?></span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <div class="w-100">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Server OS</h6>
                            <span><?php echo PHP_OS; ?></span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center pt-3">
                    <div class="w-100">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Dung lượng DB</h6>
                            <span>~5.2 MB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../template/footer.php';
?>