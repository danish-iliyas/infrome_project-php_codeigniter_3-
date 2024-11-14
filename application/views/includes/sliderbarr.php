<link rel="stylesheet" href="<?php echo base_url('assets/css/sliderbar.css'); ?>">
    <!-- Include Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">


<div class="sidebar" style="margin:0px;">
    <div class="sidebar-header">
        <h2>SuperAdmin Panel</h2>
    </div>
    <ul class="nav-links">
        <li><a href="#" class="active"><i class="icon-dashboard"></i> Dashboard</a></li>
       
            <li><a href="#"><i class="icon-user"></i> Users</a></li>
            <li><a onclick="openPopup()"  id="createOrgLink"> <i class="icon-settings"></i> Create Organization</a></li>
        
        <li><a  href="<?php echo site_url('logout'); ?>"><i class="icon-logout"></i> Logout</a></li>
    </ul>

</div>