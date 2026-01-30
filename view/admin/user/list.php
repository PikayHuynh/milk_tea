<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách người dùng</h6>
            <a href="<?php echo BASE_URL; ?>admin/add-user" class="btn btn-primary">Thêm mới</a>
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
                        <th scope="col">Avatar</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <?php 
                                    $avatarPath = get_avatar_url($user['avatar'] ?? null);
                                    ?>
                                    <img src="<?php echo $avatarPath; ?>" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                </td>
                                <td><?php echo htmlspecialchars($user['username'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($user['email'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($user['role_name'] ?? ''); ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?php echo BASE_URL; ?>admin/show-user?id=<?php echo $user['user_id']; ?>">Xem</a>
                                    <a class="btn btn-sm btn-warning" href="<?php echo BASE_URL; ?>admin/edit-user?id=<?php echo $user['user_id']; ?>">Sửa</a>
                                    <a class="btn btn-sm btn-danger" href="<?php echo BASE_URL; ?>admin/delete-user?id=<?php echo $user['user_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Không có người dùng nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../template/footer.php';
?>