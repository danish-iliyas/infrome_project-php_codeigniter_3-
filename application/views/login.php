<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <!-- Include Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-section">
        <img class="logo" src="<?php echo base_url('assets/images/zmqlogo.png'); ?>" alt="Logo">
        </div>

        <!-- Login Box -->
        <div class="login-box">
            <h2>Login</h2>
            <form  action="<?= base_url().'index.php/Login/login_post' ?>" method="POST">
                <div class="input-group">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="#">Sign up</a></p>
        </div>
    </div>
</body>
</html>
