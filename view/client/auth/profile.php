<?php
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-white p-5 rounded-5 shadow-sm border">
                    <h2 class="display-6 fw-bold mb-4 text-center">Hồ sơ cá nhân</h2>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo BASE_URL; ?>profile/update" method="POST" enctype="multipart/form-data">
                        <div class="row g-4">
                            <!-- Avatar Section -->
                            <div class="col-12 text-center mb-3">
                                <div class="position-relative d-inline-block">
                                    <?php
                                    $avatarPath = get_avatar_url($user['avatar'] ?? null);
                                    ?>
                                    <img src="<?php echo $avatarPath; ?>" alt="Avatar" class="rounded-circle shadow"
                                        style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff;">
                                    <label for="avatar"
                                        class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm"
                                        style="cursor: pointer; width: 40px; height: 40px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path
                                                d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
                                        </svg>
                                        <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                                    </label>
                                </div>
                                <p class="text-muted small mt-2">Nhấp vào icon máy ảnh để thay đổi ảnh đại diện</p>
                            </div>

                            <!-- Form Fields -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tên đăng nhập / Họ tên</label>
                                <input type="text" name="username"
                                    class="form-control form-control-lg rounded-4 bg-light border-0"
                                    value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email"
                                    class="form-control form-control-lg rounded-4 bg-light border-0"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="phone"
                                    class="form-control form-control-lg rounded-4 bg-light border-0"
                                    value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                                    placeholder="Nhập số điện thoại">
                            </div>

                            <div class="col-12 mt-5">
                                <h5 class="fw-bold mb-3">Đổi mật khẩu (Nếu cần)</h5>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mật khẩu mới</label>
                                <input type="password" name="new_password"
                                    class="form-control form-control-lg rounded-4 bg-light border-0"
                                    placeholder="••••••••">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="confirm_password"
                                    class="form-control form-control-lg rounded-4 bg-light border-0"
                                    placeholder="••••••••">
                            </div>

                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow">
                                    Lưu thay đổi
                                </button>
                                <a href="<?php echo BASE_URL; ?>" class="btn btn-link text-muted ms-3">Quay lại trang
                                    chủ</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Order History Section -->
                <div class="bg-white p-5 rounded-5 shadow-sm border mt-4">
                    <h3 class="fw-bold mb-4"><i class="bi bi-clock-history me-2"></i>Lịch sử đơn hàng</h3>

                    <?php if (empty($orders)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x display-1 text-muted"></i>
                            <p class="mt-3 text-muted">Bạn chưa có đơn hàng nào.</p>
                            <a href="<?php echo BASE_URL; ?>" class="btn btn-outline-primary rounded-pill mt-2">Mua sắm
                                ngay</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td class="fw-bold">#
                                                <?php echo $order['order_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?>
                                            </td>
                                            <td class="text-danger fw-bold">
                                                <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>đ
                                            </td>
                                            <td>
                                                <?php
                                                $statusClass = 'bg-warning';
                                                $statusText = 'Chờ xử lý';
                                                switch ($order['status']) {
                                                    case 'Completed':
                                                        $statusClass = 'bg-success';
                                                        $statusText = 'Hoàn thành';
                                                        break;
                                                    case 'Cancelled':
                                                        $statusClass = 'bg-danger';
                                                        $statusText = 'Đã hủy';
                                                        break;
                                                    case 'Shipping':
                                                        $statusClass = 'bg-info';
                                                        $statusText = 'Đang giao';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge <?php echo $statusClass; ?> rounded-pill">
                                                    <?php echo $statusText; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo BASE_URL; ?>orders/detail?id=<?php echo $order['order_id']; ?>"
                                                    class="btn btn-sm btn-outline-secondary rounded-pill">Chi tiết</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../template/footer.php';
?>