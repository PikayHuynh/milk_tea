<?php
    require_once __DIR__ . '/../../../database/config.php';
    include __DIR__ . '/../template/header.php';
?>

<div class="container-fluid pt-4 px-4">
    <div class="row mb-4">
        <div class="col-10">
            <h2 class="h4">User Detail</h2>
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

    <div class="row">
        <div class="bg-light rounded h-100 p-4">
            <div class="user-details">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($user['user_id']); ?></dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($user['email']); ?></dd>

                    <dt class="col-sm-3">Username</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($user['username']); ?></dd>

                    <dt class="col-sm-3">Role</dt>
                    <dd class="col-sm-9">
                        <?php
                            $roleName = '';
                            foreach ($roles as $role) {
                                if ($role['role_id'] == $user['role_id']) { $roleName = $role['role_name']; break; }
                            }
                            echo htmlspecialchars($roleName);
                        ?>
                    </dd>

                    <?php if (isset($user['phone'])): ?>
                        <dt class="col-sm-3">Phone</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($user['phone']); ?></dd>
                    <?php endif; ?>

                    <?php if (!empty($user['created_at'])): ?>
                        <dt class="col-sm-3">Created At</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($user['created_at']); ?></dd>
                    <?php endif; ?>
                </dl>

                <a href="<?php echo BASE_URL; ?>admin/users" class="btn btn-outline-success m-2">Back to List</a>
                <a href="<?php echo BASE_URL; ?>admin/edit-user?id=<?php echo $user['user_id']; ?>" class="btn btn-outline-warning m-2">Edit User</a>
            </div>
        </div>
    </div>

</div>



<?php
    include __DIR__ . '/../template/footer.php';
?>