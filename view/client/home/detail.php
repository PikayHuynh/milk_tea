<?php
include __DIR__ . '/../template/header.php';
?>

<section class="py-5">
    <div class="container my-5">
        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-md-6">
                <div class="product-image-container p-3 border rounded-5 bg-white shadow-sm">
                    <img src="<?php echo get_product_image_url($product['image_url']); ?>"
                        class="img-fluid rounded-4 w-100"
                        alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                        style="max-height: 500px; object-fit: cover;">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <div class="ps-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>"
                                    class="text-decoration-none">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                        </ol>
                    </nav>

                    <h1 class="display-5 fw-bold mb-3"><?php echo htmlspecialchars($product['product_name']); ?></h1>

                    <div class="d-flex align-items-center mb-4">
                        <div class="text-warning me-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-muted">(4.5 đánh giá)</span>
                    </div>

                    <h2 class="text-primary fw-bold mb-4"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                    </h2>

                    <div class="mb-4">
                        <h5 class="fw-bold">Mô tả:</h5>
                        <p class="text-muted leading-relaxed">
                            <?php echo nl2br(htmlspecialchars($product['description'] ?? 'Chưa có mô tả cho sản phẩm này.')); ?>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Số lượng:</h5>
                        <form action="<?php echo BASE_URL; ?>cart/add" method="POST"
                            class="d-flex align-items-center gap-3">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <div class="input-group" style="width: 130px;">
                                <button class="btn btn-outline-secondary rounded-start-pill" type="button"
                                    onclick="decrementQty()">-</button>
                                <input type="number" id="quantity_input" name="quantity"
                                    class="form-control text-center bg-light border-x-0" value="1" min="1">
                                <button class="btn btn-outline-secondary rounded-end-pill" type="button"
                                    onclick="incrementQty()">+</button>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                                <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </form>
                    </div>

                    <hr class="my-5 text-muted">

                    <div class="d-flex flex-column gap-2 text-muted small">
                        <span><i class="bi bi-check2-circle me-2 text-success"></i>Nguyên liệu tươi sạch 100%</span>
                        <span><i class="bi bi-truck me-2 text-success"></i>Giao hàng nhanh trong 30 phút</span>
                        <span><i class="bi bi-shield-check me-2 text-success"></i>Đảm bảo an toàn vệ sinh thực
                            phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function incrementQty() {
        var input = document.getElementById('quantity_input');
        input.value = parseInt(input.value) + 1;
    }
    function decrementQty() {
        var input = document.getElementById('quantity_input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>

<?php
include __DIR__ . '/../template/footer.php';
?>