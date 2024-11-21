<link rel="stylesheet" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
    /* Styling for success and error messages */
    /* Wrapper for the Designation Section */
    .designation-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    /* Header */
    .designation-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    /* Form Styles */
    .designation-form {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 20px;
    }

    .designation-form input[type="text"] {
        flex: 1;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .designation-form button {
        padding: 10px 20px;
        font-size: 16px;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .designation-form button:hover {
        background-color: #0056b3;
    }

    /* List Styles */
    .designation-list {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #ffffff;
    }

    .designation-item {
        padding: 5px 0;
        border-bottom: 1px solid #eee;
        font-family: Arial, sans-serif;
    }

    .designation-item:last-child {
        border-bottom: none;
    }

    .no-designations {
        text-align: center;
        color: #777;
        font-family: Arial, sans-serif;
    }

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

                <!-- #region -->
                <div class="designation-container">
                    <h2>Designation Management</h2>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div id="errorMessage" style="color: red; font-weight: bold; margin-bottom: 15px;">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form to Add Designation -->
                    <form action="<?= base_url('add') ?>" method="post" class="designation-form">
                        <input type="text" name="designation" placeholder="Enter designation" required>
                        <button type="submit">Add</button>
                    </form>

                    <!-- List of Designations -->
                    <div class="designation-list">
                        <?php if (!empty($designations)): ?>
                            <?php foreach ($designations as $designation): ?>
                                <div class="designation-item">
                                    <?= htmlspecialchars($designation['name']); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-designations">No designations found.</div>
                        <?php endif; ?>
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



    document.getElementById('assignPositionLink').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default link behavior

        // Show a loading spinner or message (optional)
        const container = document.querySelector('.designation-container');
        container.innerHTML = '<p>Loading...</p>';

        // Make AJAX request to fetch the Assign Position form
        fetch('<?php echo site_url('position_view'); ?>')
            .then(response => response.text())
            .then(html => {
                // Replace the container's content with the fetched HTML
                container.innerHTML = html;
            })
            .catch(error => {
                console.error('Error loading Assign Position form:', error);
                container.innerHTML = '<p>Error loading content. Please try again.</p>';
            });
    });
</script>