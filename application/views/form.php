<link rel="stylesheet" href="<?php echo base_url('assets/css/form.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sliderbar.css'); ?>">
<!--   copy for different role end        -->



<div class="dashboard">
<!-- child_information -->

        <div class="main-content">

        <?php $this->load->view('includes/header'); ?>
            <section class="stats-section">
                
                 <!-- <div class="stats-card " >
                    <h3>Active Users</h3>
                    <p>850</p>
                 </div>  -->
            </section>
            <div class="popup-overlay"  style="display: flex; position: relative;" id="popupOverlay">
             <div class="popup">
            <button class="btn-close"  onclick="closePopup()">X</button>
            <h2>Register New Employee</h2>
            <p>Please fill in the form below to register a new child.</p>
            <form action="<?= base_url().'add_employee' ?>"  method="post">
                <input type="text" name="username" placeholder="Employee's Name" required>
                <input type="email" name="email" placeholder="email" required>
                <input type="number" name="password" placeholder="Password" required>
                <select name="level" id="">
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                    <option value="3">Employee</option>
                </select>
               <select name="status" id="">
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

</div>

<script>
      function openPopup() {
        // document.getElementById('popupOverlay').style.display = 'flex';
        // document.body.classList.add('blur-background');

        document.getElementById('dashboard').style.display = 'block';
        document.body.classList.add('blur-background');
    }
        function closePopup() {
            document.getElementById('popupOverlay').style.display = 'none';
            document.body.classList.remove('blur-background');
        }
</script>