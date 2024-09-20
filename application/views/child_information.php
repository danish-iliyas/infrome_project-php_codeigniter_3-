<link rel="stylesheet" href="<?php echo base_url('assets/css/childinformation.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sliderbar.css'); ?>">
<!--   copy for different role end        -->

    

<div class="dashboard">


        <div class="main-content">

      
            <section class="stats-section">
                
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
            <form action="<?= base_url().'index.php/Child_Registration/addchilddata' ?>"  method="post">
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
   
</div>

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