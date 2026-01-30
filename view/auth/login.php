<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Milk Tea Shop</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 15px;
            text-align: center;
        }

        .links {
            margin-top: 15px;
            text-align: center;
            font-size: 0.9em;
        }

        .links a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="error" style="color: green;"><?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form action="<?php echo $baseUrl; ?>/auth/login" method="POST">
            <div class="form-group">
                <label>Username hoặc Email</label>
                <input type="text" name="identifier" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Đăng Nhập</button>
        </form>
        <div class="links">
            <a href="<?php echo $baseUrl; ?>/register">Đăng ký tài khoản</a>
        </div>
    </div>
</body>

</html>