<link rel="stylesheet" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
  /* Styling for success and error messages */
  .alert {
    margin-top: 20px;
    padding: 10px;
    border-radius: 5px;
  }

  .alert-success {
    color: #155724;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
  }

  .alert-error {
    color: #721c24;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
  }
</style>

<div class="dashboard">
  <div class="containersliderandmaincontent " style="display: flex; width: 100%;">
    <?php $this->load->view('includes/sliderbarr'); ?>


    <div class="main-content">

      <!-- Header section -->
      <?php $this->load->view('includes/headerr'); ?>


      <section class="users-section">
       

        <!-- #region open form -->
        <?php if ($this->session->flashdata('success')): ?>
          <p id="successMessage" style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
          <p id="errorMessage" style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>

        <div class="popup-overlay" style="display: none; position: relative ;" id="popupOverlay">

          <div class="popup">
            <button class="btn-close" onclick="closePopup()">X</button>
            <div class="form-container">
              <h2>Organization and Contact Details</h2>

              <form method="post" action="<?php echo base_url('OrganizationController/saveOrganization'); ?>">
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

                  <label for="userid">USER ID:</label>
                  <input type="text" id="userid" name="userid" required>

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
  document.addEventListener('DOMContentLoaded', function () {
    const createOrgLink = document.getElementById('createOrgLinkk');
    if (createOrgLink) {
      createOrgLink.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default link behavior
        openPopup(); // Open the popup form
      });
    }
  });

  setTimeout(function () {
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    if (successMessage) {
      successMessage.style.display = 'none';
    }
    if (errorMessage) {
      errorMessage.style.display = 'none';
    }
  }, 2000); 
</script>