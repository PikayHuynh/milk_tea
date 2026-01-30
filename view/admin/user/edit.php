<?php
    require_once __DIR__ . '/../../../database/config.php';
    include __DIR__ . '/../template/header.php';
?>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-10">
            <h2 class="h4">Edit User</h2>
        </div>
        <div class="col-2 text-end">
            <a href="<?php echo BASE_URL; ?>admin/users" class="btn btn-outline-primary m-2">Back to List</a>
        </div>
    </div>

     <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo BASE_URL; ?>admin/update-user" class="form-user">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" 
                value="<?php echo htmlspecialchars($user['email']); ?>">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" name="username" 
                value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="phone" name="phone" 
                value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-select" id="role_id" name="role_id" required>
                <option value="">Select a role</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['role_id']; ?>" 
                            <?php echo $role['role_id'] == $user['role_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($role['role_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-outline-warning m-2">Update User</button>
        <a href="<?php echo BASE_URL; ?>admin/users" class="btn btn-outline-success m-2">Cancel</a>
    </form>
</div>


<?php
    include __DIR__ . '/../template/footer.php';
?>