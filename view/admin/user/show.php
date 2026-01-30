<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6 class="mb-4">Thông tin chi tiết người dùng</h6>

        <div class="row mb-4">
            <div class="col-sm-3 text-center">
                <?php
                $avatarPath = get_avatar_url($user['avatar'] ?? null);
                ?>
                <img src="<?php echo $avatarPath; ?>" alt="User Avatar" class="img-fluid rounded-circle shadow-sm"
                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #eee;">
            </div>
            <div class="col-sm-9">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><?php echo $user['user_id']; ?></dd>

                    <dt class="col-sm-3">Username</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($user['username']); ?></dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($user['email']); ?></dd>

                    <dt class="col-sm-3">Phone</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></dd>

                    <dt class="col-sm-3">Role</dt>
                    <dd class="col-sm-9">
                        <?php
                        foreach ($roles as $role) {
                            if ($role['role_id'] == $user['role_id']) {
                                echo htmlspecialchars($role['role_name']);
                                break;
                            }
                        }
                        ?>
                    </dd>

                    <dt class="col-sm-3">Created At</dt>
                    <dd class="col-sm-9"><?php echo $user['created_at']; ?></dd>
                </dl>

                <a href="<?php echo BASE_URL; ?>admin/edit-user?id=<?php echo $user['user_id']; ?>"
                    class="btn btn-warning">Sửa</a>
                <a href="<?php echo BASE_URL; ?>admin/users" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>

        <?php
        include __DIR__ . '/../template/footer.php';
        ?>