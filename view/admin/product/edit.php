<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6 class="mb-4">Chỉnh sửa sản phẩm</h6>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>admin/update-product" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <div class="mb-3">
                <label for="product_name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="<?php echo htmlspecialchars($product['product_name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php echo ($product['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Số lượng kho</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                    value="<?php echo $product['stock_quantity']; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description"
                    rows="3"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (Để trống nếu không đổi)</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if (!empty($product['image_url'])): ?>
                    <div class="mt-2">
                        <img src="<?php echo get_product_image_url($product['image_url']); ?>" alt="" style="width: 100px;">
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo BASE_URL; ?>admin/products" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>

<?php
include __DIR__ . '/../template/footer.php';
?>