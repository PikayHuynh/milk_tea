<?php
require_once __DIR__ . '/../../../database/config.php';
include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6 class="mb-4">Chỉnh sửa người dùng</h6>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>admin/update-user" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar (Để trống nếu không đổi)</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                <div class="mt-2">
                    <?php
                    $avatarPath = get_avatar_url($user['avatar'] ?? null);
                    ?>
                    <img src="<?php echo $avatarPath; ?>" alt="Current Avatar"
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (Để trống nếu không đổi)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select" id="role_id" name="role_id" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['role_id']; ?>" <?php echo ($user['role_id'] == $role['role_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($role['role_name'] ?? ''); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="<?php echo BASE_URL; ?>admin/users" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>

<?php
include __DIR__ . '/../template/footer.php';
?>