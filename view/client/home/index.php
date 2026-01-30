<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
include __DIR__ . '/../template/banner.php';
?>

<section class="py-5">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="bootstrap-tabs product-tabs">
                    <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                        <h3>Sản phẩm nổi bật</h3>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a href="#" class="nav-link text-uppercase fs-6 active" id="nav-all-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-all">Tất cả sản phẩm</a>
                            </div>
                        </nav>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                            aria-labelledby="nav-all-tab">

                            <div
                                class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <div class="col mb-4">
                                            <div
                                                class="product-item h-100 border rounded-5 p-3 shadow-sm bg-white transition-hover">
                                                <figure class="mb-3">
                                                    <a href="<?php echo BASE_URL; ?>product-detail?id=<?php echo $product['product_id']; ?>"
                                                        title="<?php echo htmlspecialchars($product['product_name']); ?>">
                                                        <img src="<?php echo get_product_image_url($product['image_url']); ?>"
                                                            class="img-fluid rounded-4"
                                                            style="width: 100%; height: 220px; object-fit: cover;">
                                                    </a>
                                                </figure>
                                                <h3 class="fs-5 fw-bold mb-1">
                                                    <a href="<?php echo BASE_URL; ?>product-detail?id=<?php echo $product['product_id']; ?>"
                                                        class="text-decoration-none text-dark d-block text-truncate">
                                                        <?php echo htmlspecialchars($product['product_name']); ?>
                                                    </a>
                                                </h3>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span
                                                        class="price fw-bold text-primary fs-5"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                                                    <a href="<?php echo BASE_URL; ?>product-detail?id=<?php echo $product['product_id']; ?>"
                                                        class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        Chi tiết
                                                    </a>
                                                </div>
                                                <form action="<?php echo BASE_URL; ?>cart/add" method="POST">
                                                    <input type="hidden" name="product_id"
                                                        value="<?php echo $product['product_id']; ?>">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input type="number" name="quantity"
                                                            class="form-control form-control-sm rounded-pill text-center bg-light border-0"
                                                            value="1" min="1" style="width: 60px;">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm flex-grow-1 rounded-pill fw-bold">
                                                            <i class="bi bi-cart-plus me-1"></i> Thêm
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="col-12 text-center">Chưa có sản phẩm nào. </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../template/banner-content.php';
include __DIR__ . '/../template/footer.php';
?>