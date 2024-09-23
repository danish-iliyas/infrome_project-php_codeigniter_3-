<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">
    <!-- Include Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
 
                     
               <!-- // Correctly accessing the 'level' value
                print_r($level);  //output = 0,1,2
                 exit;
    -->

      <?php $this->load->view('includes/sliderbar'); ?>

         <!-- Main Content -->

        <!--  copy for different role start -->
         <?php if ($level == 0): ?>
        <div class="main-content">
        <?php $this->load->view('includes/header'); ?>
      
            <section class="stats-section">
                <div class="stats-card">
                    <h3>Total Users</h3>
                    <p>1200</p>
                </div>
                <div class="stats-card">
                    <h3>Active Users</h3>
                    <p>850</p>
                </div>
                <div class="stats-card">
                    <h3>New Signups</h3>
                    <p>300</p>
                </div>
                <div class="stats-card">
                    <h3>Admin Tasks</h3>
                    <p>12 Pending</p>
                </div>
            </section>

            <section class="users-section">
                <h2>Manage Users</h2>
                <button class="btn-add-user">Add New User</button>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <!-- More rows can be added here -->
                    </tbody>
                </table>
            </section>
            <section class="users-section">
                <h2>Manage Users</h2>
                <button class="btn-add-user">Add New User</button>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                       
                        <!-- More rows can be added here -->
                    </tbody>
                </table>
            </section>
        </div>
    </div>


         <!--  copy for different role start -->
         <?php elseif ($level == 1): ?>
        <div class="main-content">
            <!-- Header section -->
        <?php $this->load->view('includes/header'); ?>
      
            <section class="stats-section">
                <div class="stats-card">
                    <h3>Total Users</h3>
                    <p><?php echo $total_users; ?></p>
                </div>
                <div class="stats-card">
                    <h3>Total children Registrations</h3>
                    <p> <?php echo $total_children; ?></p>
                </div>
                <div class="stats-card">
                    <h3>Admin</h3>
                    <p>1</p>
                </div>
                <!-- <div class="stats-card">
                    <h3>Admin Tasks</h3>
                    <p>12 Pending</p>
                </div> -->
            </section>
<!--  
            <section class="users-section">
                <h2>Manage Users</h2>
                <button class="btn-add-user">Add New User</button>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </section>
           -->
        </div>
    </div>

<!--   copy for different role end        -->
    <?php elseif ($level == 2): ?>
        <div class="main-content">
        <?php $this->load->view('includes/header'); ?>
      
            <section class="stats-section">
                <div class="stats-card">
                    <h3>Total Registrations</h3>
                    <p> <?php echo $total_children; ?></p>
                </div>
                <!-- <div class="stats-card">
                    <h3>Active Users</h3>
                    <p>850</p>
                </div> -->
                <!-- <div class="stats-card">
                    <h3>New Signups</h3>
                    <p>300</p>
                </div> -->
                <!-- <div class="stats-card">
                    <h3>Admin Tasks</h3>
                    <p>12 Pending</p>
                </div> -->
            </section>

            <div class="popup-overlay"  style="display: none; position: absolute;" id="popupOverlay">
             <div class="popup">
            <button class="btn-close"  onclick="closePopup()">X</button>
            <h2>Register New Child</h2>
            <p>Please fill in the form below to register a new child.</p>
            <form action="<?= base_url().'add_child' ?>"  method="post">
                <input type="text" name="name" placeholder="Child's Name" required>
                <input type="text" name="father_name" placeholder="Father's Name" required>
                <input type="text" name="mother_name" placeholder="Mother's Name" required>
                <select name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>
            
        </div>
    </div>
    <?php else: ?>
    <h2>Guest Section</h2>
    <p>Content for guests or unauthorized users.</p>
<?php endif; ?>

<script>
      function openPopup() {
        document.getElementById('popupOverlay').style.display = 'flex';
        // document.body.classList.add('blur-background');

        document.getElementById('dashboard').style.display = 'block';
        document.body.classList.add('blur-background');
    }
    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.body.classList.remove('blur-background');
    }
</script>
</body>
</html>
