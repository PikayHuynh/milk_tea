<?php

/**
 * Tự động khởi tạo dữ liệu cơ bản nếu chưa tồn tại
 * @param PDO $pdo
 */
function auto_init_database($pdo)
{
    try {
        // 1. Đảm bảo cột avatar tồn tại (Phòng trường hợp DB cũ chưa update)
        $checkCol = $pdo->query("SHOW COLUMNS FROM `user` LIKE 'avatar'");
        if (!$checkCol->fetch()) {
            $pdo->exec("ALTER TABLE `user` ADD COLUMN avatar VARCHAR(255) DEFAULT 'user.jpg' AFTER role_id");
        }

        // 2. Kiểm tra và tạo Roles
        $stmt = $pdo->query("SELECT COUNT(*) FROM `role`");
        if ($stmt->fetchColumn() == 0) {
            $pdo->exec("INSERT INTO `role` (role_id, role_name) VALUES 
                (1, 'Admin'), 
                (2, 'Staff'), 
                (3, 'User')");
        }

        // 3. Kiểm tra và tạo Admin mặc định
        $stmt = $pdo->query("SELECT COUNT(*) FROM `user` WHERE role_id = 1");
        if ($stmt->fetchColumn() == 0) {
            $adminData = [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role_id' => 1,
                'avatar' => 'user.png'
            ];
            $sql = "INSERT INTO `user` (username, email, password, role_id, avatar) VALUES (:username, :email, :password, :role_id, :avatar)";
            $insert = $pdo->prepare($sql);
            $insert->execute($adminData);
        }
    } catch (PDOException $e) {
        // Ghi log lỗi nếu cần, nhưng không được dừng hệ thống ở đây
        error_log("Auto-Init Error: " . $e->getMessage());
    }
}
