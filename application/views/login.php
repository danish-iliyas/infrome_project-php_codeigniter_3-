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
        <?php if($this->session->flashdata('error')): ?>
    <div id="errorMessage" style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>

            <h2>Login</h2>
 
            <form action="<?= base_url('login') ?>" method="POST">
                <div class="input-group">
                    <input type="text" name="userid" required>
                    <label>Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <p class="signup-link">Do you have an account ?<a href="#"><br>Please Login.</a></p>
        </div>
    </div>
</body>
</html>
<script>

// Automatically hide the error message after 3 seconds
setTimeout(function() {
    var errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        errorMessage.style.display = 'none';
    }
}, 3000); // 3000 milliseconds = 3 seconds
</script>