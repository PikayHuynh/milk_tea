<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang quảng trị</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php
    require_once __DIR__ . '/../../../database/config.php';
    ?>

    <!-- Favicon -->
    <link href="<?php echo admin_asset_url('img/favicon.ico'); ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo admin_asset_url("lib/owlcarousel/assets/owl.carousel.min.css") ?>" rel="stylesheet">
    <link href="<?php echo admin_asset_url("lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css") ?>"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo admin_asset_url("css/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo admin_asset_url("css/style.css") ?>" rel="stylesheet">
    <!-- Admin Custom Styles -->
    <link href="<?php echo admin_asset_url("css/admin-custom.css") ?>" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar navbar-dark">
                <a href="<?php echo BASE_URL; ?>admin" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-utensils me-2"></i>MILK TEA</h3>
                </a>
                <?php
                $user_image = get_avatar_url($_SESSION['avatar'] ?? null);
                ?>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $user_image; ?>" alt=""
                            style="width: 40px; height: 40px; object-fit: cover;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3 user-info">
                        <h6 class="mb-0"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></h6>
                        <span><?php echo htmlspecialchars($_SESSION['role_name'] ?? 'Quản trị viên'); ?></span>
                    </div>
                </div>
                <?php
                $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $admin_path = BASE_URL . 'admin';
                ?>
                <div class="navbar-nav w-100">
                    <a href="<?php echo $admin_path; ?>"
                        class="nav-item nav-link <?php echo ($current_path == $admin_path || $current_path == $admin_path . '/') ? 'active' : ''; ?>">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="<?php echo $admin_path; ?>/users"
                        class="nav-item nav-link <?php echo (strpos($current_path, 'user') !== false) ? 'active' : ''; ?>">
                        <i class="fa fa-users me-2"></i>Người dùng
                    </a>
                    <a href="<?php echo $admin_path; ?>/products"
                        class="nav-item nav-link <?php echo (strpos($current_path, 'product') !== false) ? 'active' : ''; ?>">
                        <i class="fa fa-mug-hot me-2"></i>Sản phẩm
                    </a>
                    <a href="<?php echo $admin_path; ?>/orders"
                        class="nav-item nav-link <?php echo (strpos($current_path, 'order') !== false) ? 'active' : ''; ?>">
                        <i class="fa fa-list-alt me-2"></i>Đơn hàng
                    </a>
                    <hr class="mx-3 my-2 text-secondary">
                    <a href="<?php echo BASE_URL; ?>profile"
                        class="nav-item nav-link <?php echo (strpos($current_path, BASE_URL . 'profile') !== false) ? 'active' : ''; ?>">
                        <i class="fa fa-user-circle me-2"></i>Hồ sơ cá nhân
                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="<?php echo BASE_URL; ?>admin" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo $user_image; ?>" alt=""
                                style="width: 40px; height: 40px; object-fit: cover;">
                            <span
                                class="d-none d-lg-inline-flex"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="<?php echo BASE_URL; ?>profile" class="dropdown-item">Thông tin cá nhân</a>
                            <a href="<?php echo BASE_URL; ?>logout" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->