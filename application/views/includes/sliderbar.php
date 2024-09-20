<link rel="stylesheet" href="<?php echo base_url('assets/css/sliderbar.css'); ?>">
    <!-- Include Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<!-- Sidebar -->
<?php if ($level == 0): ?>
  <div class="sidebar" style = "margin:0px;">
            <div class="sidebar-header">
                <h2>SuperAdmin Panel</h2>
            </div>
            <ul class="nav-links">
                <li><a href="#" class="active"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="icon-user"></i> Users</a></li>
                <li><a href="#"><i class="icon-settings"></i> Settings</a></li>
                <li><a href="<?php echo site_url('Login/logout'); ?>" ><i class="icon-logout"></i> Logout</a></li>
            </ul>
        </div>
        
        <?php elseif ($level == 1): ?>
            <div class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="nav-links">
                <!-- <li><a href="#" class="active"><i class="icon-dashboard"></i> Dashboard</a></li> -->
                <li><a href="#"><i class="icon-user"></i> Users</a></li>
                <li><a href="#"><i class="icon-settings"></i> Settings</a></li>
                <li><a href="<?php echo site_url('Login/logout'); ?>" ><i class="icon-logout"></i> Logout</a></li>
            </ul>
        </div>

        <?php elseif ($level == 2): ?>
            <div class="sidebar">
            <div class="sidebar-header"> 
            <h2>Welcome, <?php echo $username; ?>!</h2>
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo site_url('Dashboard'); ?>" class="active"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li><a href="<?php echo site_url('Dashboard/child_information'); ?>"><i class="icon-user"></i> <?php echo $username; ?></a></li>
                <!-- <li><a href="#"><i class="icon-settings"></i> Settings</a></li> -->
                <li><a href="<?php echo site_url('Login/logout'); ?>" ><i class="icon-logout"></i> Logout</a></li>
            </ul>
        </div>

        <?php else: ?>
            <div class="sidebar">
            <div class="sidebar-header">
        <h2>Guest Section</h2>
        <p>Content for guests or unauthorized users.</p>
        </div>
        </div>
    <?php endif; ?>