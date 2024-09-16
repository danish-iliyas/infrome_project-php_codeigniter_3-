<link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<header>
    <?php if ($level == 0): ?>
        <h1>Dashboard Overview</h1>
        <div class="header-right">
            <input type="search" placeholder="Search...">
            <button class="btn-notify"><i class="icon-bell"></i></button>
            <div class="logout">
            <img class="user-avatar" src="<?php echo base_url('assets/images/zmqlogo.png'); ?>" alt="Logo">
            <button class="btn-logout"><a href="<?= base_url().'index.php/Login/logout' ?>">Logout</a></button>
            </div>
        </div>
    <?php elseif ($level == 1): ?>
        <h1>Admin Overview</h1>
        <div class="header-right">
            <input type="search" placeholder="Search...">
            <button class="btn-notify"><i class="icon-bell"></i></button>
            <div class="logout">
            <img class="user-avatar" src="<?php echo base_url('assets/images/zmqlogo.png'); ?>" alt="Logo">
            <button class="btn-logout"><a href="<?= base_url().'index.php/Login/logout' ?>">Logout</a></button>
            </div>
        </div>
    <?php elseif ($level == 2): ?>
        <h1>User Overview</h1>
        <div class="header-right">
            <input type="search" placeholder="Search...">
            <button class="btn-notify"><i class="icon-bell"></i></button>
            <div class="logout">
            <img class="user-avatar" src="<?php echo base_url('assets/images/zmqlogo.png'); ?>" alt="Logo">
            <button class="btn-logout"><a href="<?= base_url().'index.php/Login/logout' ?>">Logout</a></button>
            </div>
        </div>
    <?php else: ?>
        <h2>Guest Section</h2>
        <p>Content for guests or unauthorized users.</p>
    <?php endif; ?>
</header>
