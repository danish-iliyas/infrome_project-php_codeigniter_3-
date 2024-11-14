<link rel="stylesheet" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">
    <!-- Include Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">


<div class="dashboard">
<div class="containersliderandmaincontent " style ="display: flex; width: 100%;">
<?php $this->load->view('includes/sliderbarr'); ?>


<div class="main-content">

            <!-- Header section -->
            <?php $this->load->view('includes/headerr'); ?>  
              
            
            <section class="users-section">


           
<div class="popup-overlay"  style="display: none; position: relative ;" id="popupOverlay">
             <div class="popup">
            <button class="btn-close"  onclick="closePopup()">X</button>
  <div class="form-container">
    <h2>Organization and Contact Details</h2>

    <form action="submit_details.php" method="POST">
      <!-- Organization Details Section -->
      <fieldset>
        <legend>Organization Details</legend>
        
        <label for="organizationname">Organization Name:</label>
        <input type="text" id="organizationname" name="organizationname" required>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" required>

        <label for="level">Level:</label>
        <input type="text" id="level" name="level" required>
      </fieldset>

      <!-- Contact Details Section -->
      <fieldset>
        <legend>Contact Details</legend>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="usseid">USSE ID:</label>
        <input type="text" id="usseid" name="usseid" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </fieldset>

      <button type="submit">Submit</button>
    </form>
  </div>
  </div>
</div>
                
            </section>  
          
        </div>
     
    </div>
  
  
    </div>
  


<script>
     function openPopup() {
        document.getElementById('popupOverlay').style.display = 'flex';
        document.getElementById('popupOverlay').style.position = 'relative  ';
        
        // Hide the user table if it exists
        const userTable = document.querySelector('.users-table');
        if (userTable) {
            userTable.style.display = 'none';
        }
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        
        // Show the user table again if it was hidden
        const userTable = document.querySelector('.users-table');
        if (userTable) {
            userTable.style.display = 'table';
        }
    }

    // Listen for the click event on the "Create Organization" link
    document.addEventListener('DOMContentLoaded', function() {
        const createOrgLink = document.getElementById('createOrgLink');
        if (createOrgLink) {
            createOrgLink.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default link behavior
                openPopup(); // Open the popup form
            });
        }
    });
</script>