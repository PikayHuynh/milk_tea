<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách sản phẩm</h6>
            <a href="<?php echo BASE_URL; ?>admin/add-product" class="btn btn-primary">Thêm mới</a>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><img src="<?php echo get_product_image_url($product['image_url']); ?>" alt="" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                <td><?php echo htmlspecialchars($product['product_name'] ?? ''); ?></td>
                                <td><?php echo number_format($product['price']); ?> VND</td>
                                <td><?php echo $product['stock_quantity']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="<?php echo BASE_URL; ?>admin/edit-product?id=<?php echo $product['product_id']; ?>">Sửa</a>
                                    <a class="btn btn-sm btn-danger" href="<?php echo BASE_URL; ?>admin/delete-product?id=<?php echo $product['product_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">Không có sản phẩm nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../template/footer.php';
?>
