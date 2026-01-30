<?php
    require_once __DIR__ . '/../../../database/config.php';
    include __DIR__ . '/../template/header.php';
?>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-10">
            <h2 class="main-title">Users Management</h2>
        </div>
        <div class="col-2">
            <a href="<?php echo BASE_URL; ?>admin/add-user" class="btn btn-outline-primary m-2">
                <i class="feather icon-plus"></i> Add New User
            </a>
        </div>


        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">

                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <th><?php echo $user['user_id']; ?></th>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['phone']; ?></td>
                                        <td><?php echo $user['role_name']; ?></td>
                                        <td>
                                            <a class="btn btn-outline-primary m-2" href="<?php echo BASE_URL; ?>admin/show-user?id=<?php echo $user['user_id']; ?>">Show</a>
                                            <a class="btn btn-outline-warning m-2" href="<?php echo BASE_URL; ?>admin/edit-user?id=<?php echo $user['user_id']; ?>">Edit</a>
                                            <a class="btn btn-outline-danger m-2" href="<?php echo BASE_URL; ?>admin/delete-user?id=<?php echo $user['user_id'] ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No users found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include __DIR__ . '/../template/footer.php';
?>