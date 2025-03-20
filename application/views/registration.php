<link rel="stylesheet" href="<?php echo base_url('assets/css/childinformation.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sliderbar.css'); ?>">
<!--   copy for different role end        -->

<style>
   /* General popup styles */
.popup {
    background-color: #fff;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: auto;
}

.btn-close {
    float: right;
    background-color: red;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

.child-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Flexbox for two-column layout */
.form-container {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap; /* Allow items to wrap to the next line when necessary */
}

/* Form Column */
.form-column {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 15px;
    min-width: 220px; /* Ensure the columns don't get too narrow */
}

/* Input and Select styling */
.form-column input, .form-column select {
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
}

/* Submit Button Styling */
.form-actions {
    text-align: center;
    margin-top: 20px;
}

.btn-submit {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

</style>
    
<?php if ($level == 2): ?>
<div class="dashboard">
<!-- child_information -->

        <div class="main-content">

        <?php $this->load->view('includes/header'); ?>
            <section class="stats-section">
                
                <!-- <div class="stats-card">
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
                </div> -->
            </section>
          <div class="popup-overlay" style="display: none; position: relative;" id="popupOverlay">
    <div class="popup">
        <button class="btn-close" onclick="closePopup()">X</button>
        <h2>Register New Child</h2>
        <p>Please fill in the form below to register a new child.</p>

        <form action="<?= base_url().'add_child' ?>" method="post" class="child-form">
            <!-- Form split into two parts -->
            <div class="form-container">
                <!-- Left Side: Name, Father's Name, Mother's Name -->
                <div class="form-column">
                    <input type="text" name="name" placeholder="Child's Name" required>
                    <input type="text" name="father_name" placeholder="Father's Name" required>
                    <input type="text" name="mother_name" placeholder="Mother's Name" required>
                </div>

                <!-- Right Side: Gender and other fields -->
                <div class="form-column">
                    <select name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    <select name="region_id" id="regionDropdown">
                        <!-- Regions will be dynamically populated here -->
                    </select>

                    <select name="creater_id" id="registerByDropdown" style="display:none;">
                        <!-- Users (e.g., Central Admin, Doctor, Health Worker) will be populated dynamically -->
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>
</div>

            <section class="users-section">
                <!-- <h2>Manage Child</h2> for feature -->
                <button class="btn-add-user" id = "openPopup" onclick="openPopup()"> Child Registrations</button>
                
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Father's Name</th> 
                            <th>Mother's Name</th>
                            <th>Gender</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        
                        <?php foreach ($children as $child): ?>
                        <tr>
                        
                            <td><?php echo $child['name'] ?></td>
                            <td><?php echo $child['father_name'] ?></td>
                            <td><?php echo $child['mother_name'] ?></td>
                           <td><?php echo $child['gender'] ?></td>
                           
                            <!-- <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td> -->
                            
                        </tr>
                        <?php endforeach; ?>
                           
                            <!-- <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td> -->
                            
                   
                        
                        <!-- More rows can be added here -->
                    </tbody>
                </table>    
            </section>
        </div>
    </div>  
    <!-- <?php $this->load->view('includes/footer');?> -->
</div>
<!-- employee_registration section -->
<?php elseif ($level == 1): ?>
    <div class="dashboard">
    <!-- child_information -->
    <div class="main-content">

        <?php $this->load->view('includes/header'); ?>
        <section class="stats-section">
            <!-- <div class="stats-card">
                <h3>Active Users</h3>
                <p>850</p>
            </div> -->
        </section>

        <div class="popup-overlay" style="display: none; position: relative;" id="popupOverlay">
            <div class="popup">
                <button class="btn-close" onclick="closePopup()">X</button>
                <h2>Register New Employee</h2>
                <p>Please fill in the form below to register a new employee.</p>
                <form action="<?= base_url().'add_employee' ?>" method="post">
    <input type="text" name="userid" placeholder="Employee's Name" required>
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="level" id="levelSelect" onchange="handleRoleChange(this.value)">
        <option value="">Select level</option>
        <option value="2">Central Admin</option>
        <option value="3">Doctor</option>
        <option value="4">Health Worker</option>
        <option value="5">User</option>
    </select>

    <!-- Register by dropdown (Doctor, Health Worker) -->
    <select name="creater_id" id="registerByDropdown" style="display:none;">
        <!-- Users (e.g., Central Admin, Doctor, Health Worker) will be populated dynamically -->
    </select>
        <!-- Dropdown for region (only for Central Admin) -->
        <div id="regionDropdownDiv" style="display:none;">
                <label for="region">Select Region:</label>
                <select name="region_id" id="regionDropdown">
                    <!-- Regions will be dynamically populated here -->
                </select>
            </div>    
        <!-- Region input, hidden by default (only for Central Admin) -->
        <div id="regionInputDiv" style="display:none;">
            <input type="text" name="region" id="regionInput" placeholder="Enter Region">
        </div>
 
    <select name="is_active" required>
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <select name="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <button type="submit" class="btn-submit">Submit</button>
</form>
            </div>
        </div>

        <!-- employee_Datat -->
        <section class="users-section">
            <!-- <h2>Manage Employee</h2> -->
            <button class="btn-add-user" id="openPopup" onclick="openPopup()">Employee Registrations</button>

            <table class="users-table">
                <thead>
                    <tr>
                        <th>userid</th>
                        <th>email</th>
                        <th>level</th>
                        <th>is_active</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?> 
                    <tr>
                        <td><?php echo $user['userid'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['level'] ?></td>
                        <td>
                            <?php if ($user['is_active'] === '1'): ?>
                            <form action="<?= base_url('Dashboard/toggle_status/'.$user['id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="is_active" value="0">
                                <button type="submit" class="btn-deactivate" onclick="return confirm('Are you sure you want to deactivate this user?');">Deactivate</button>
                            </form>
                            <?php else: ?>
                            <form action="<?= base_url('Dashboard/toggle_status/'.$user['id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="is_active" value="1">
                                <button type="submit" class="btn-activate" onclick="return confirm('Are you sure you want to activate this user?');">Activate</button>                </form>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $user['gender'] ?></td>
                        <td>
                            <form action="<?= base_url('delete_user/'.$user['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

  
</div>
    <!-- end section -->
<?php else: ?>
    <h2>Guest Section</h2>
    <p>Content for guests or unauthorized users.</p>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   function handleRoleChange(selectedLevel) {
    // Reset the display of region dropdown and input
    document.getElementById("regionDropdownDiv").style.display = "none";  // Hide region dropdown by default
    document.getElementById("regionInputDiv").style.display = "none";     // Hide region input by default
    document.getElementById("registerByDropdown").style.display = "block"; // Show creater_id by default

    if (selectedLevel == "2") {
        // Show region dropdown for Central Admin
        document.getElementById("regionDropdownDiv").style.display = "block";
        // Hide creater_id for Central Admin
        document.getElementById("registerByDropdown").style.display = "none";
        fetchRegions();  // Fetch regions if Central Admin is selected
    } else {
        // For other roles, show region input or other relevant content if needed
        document.getElementById("registerByDropdown").style.display = "block"; // Show creater_id for other roles
        fetchUsersByRole(selectedLevel);  // Fetch users based on the selected level (Doctor, Health Worker, etc.)
    }
}

    function fetchRegions() {
    $.ajax({
        url: '<?= base_url("Dashboard/getRegions") ?>', // Your controller method to fetch regions
        type: 'GET',
        success: function(response) {
            var regions = JSON.parse(response);
            console.log(regions,"regions");
            var regionDropdown = document.getElementById('regionDropdown');
            regionDropdown.innerHTML = ''; // Clear existing options
            
            regions.forEach(function(region) {
                var option = document.createElement('option');
                option.value = region.id; // Assuming 'id' is the primary key of your region table
                option.textContent = region.region; // Assuming 'region_name' is the name of the region
                regionDropdown.appendChild(option);
            });
        }
    });
}

    function fetchUsersByRole(selectedLevel) {
        $.ajax({
            url: '<?= base_url("Dashboard/get_users_by_role") ?>',
            type: 'POST',
            data: { selected_level: selectedLevel },
            dataType: 'json',
            success: function(response) {
                var dropdown = $('#registerByDropdown');
                dropdown.empty(); // Clear previous options
                // console.log(user.id,"user.id");
                $.each(response, function(index, user) {
                    dropdown.append($('<option>', {
                        value: user.id,
                        text: user.userid
                    }));
                });

                // Show the dropdown if there are users
                if (response.length > 0) {
                    dropdown.show();
                } else {
                    dropdown.hide();
                }
            },
            error: function() {
                alert('Error fetching users');
            }
        });
    }

      function openPopup() {
        document.getElementById('popupOverlay').style.display = 'flex';
        document.getElementById('openPopup').style.display = 'none';
        
        // Hide the user table
        const userTable = document.querySelector('.users-table'); // Correct selector
        if (userTable) {
            userTable.style.display = 'none'; // Hiding the table
        }
    }
    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.body.classList.remove('blur-background');
        document.getElementById('openPopup').style.display = 'block';

        // Show the user table again when the popup is closed
        const userTable = document.querySelector('.users-table');
        if (userTable) {
            userTable.style.display = 'table'; // Displaying the table
        }
    }
</script>