<link rel="stylesheet" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
    /* Table styling */
    .child-table-container {
        max-height: 400px; /* Set your desired max height */
        overflow-y: auto;  /* Enable vertical scrolling */
        margin-top: 20px;
    }

    .child-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .child-table th, .child-table td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #f1f1f1;
        font-size: 16px;
        color: #333;
    }

    .child-table th {
        background-color: #4caf50; /* Green color for table header */
        color: white;
        font-weight: 600;
        text-transform: uppercase;
    }

    .child-table tr:nth-child(even) {
        background-color: #f9f9f9; /* Light grey for alternating rows */
    }

    .child-table td {
        color: #555;
    }

    .child-table td[colspan="6"] {
        text-align: center;
        font-weight: 500;
        color: #888;
        padding: 20px;
    }

    /* Table hover effect */
    .child-table tr:hover {
        background-color: #f1f1f1; /* Hover effect for rows */
    }

    /* Action icons styling */
    .action-icons {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .action-icons a {
        position: relative;
        padding: 5px;
        color: #555;
        font-size: 18px;
        transition: color 0.3s;
    }

    .action-icons a:hover {
        color: #4caf50; /* Change icon color on hover */
    }

    .action-icons a:hover::after {
        content: attr(data-tooltip); /* Display the tooltip */
        position: absolute;
        top: -28px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4caf50;
        color: #fff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
    }

    .action-icons a.approve-icon::before {
        content: "\2714"; /* Unicode checkmark */
    }

    .action-icons a.disapprove-icon::before {
        content: "\2718"; /* Unicode cross mark */
    }

    .action-icons a.show-icon::before {
        content: "\1F50D"; /* Unicode magnifying glass */
    }

</style>

<!-- In your HTML, wrap the table with a div container for scrolling -->
<div class="dashboard">
    <div class="containersliderandmaincontent" style="display: flex; width: 100%;">
        <?php $this->load->view('includes/sliderbar'); ?>
        <div class="main-content">
            <?php $this->load->view('includes/header'); ?>

            <!-- Conditional content based on user level -->
            <?php if ($this->session->userdata('level') == 4): ?>
                <!-- Health Worker Section -->
                <h2>Children Managed by Health Worker</h2>
            <?php elseif ($this->session->userdata('level') == 3): ?>
                <!-- Doctor Section -->
                <h2>Children Managed by Doctor</h2>
            <?php endif; ?>

            <!-- Wrap the table inside the scroll container -->
<!-- Wrap the table inside the scroll container -->
<div class="child-table-container">
    <table class="child-table">
        <thead>
            <tr>
                <th>Child's Name</th>
                <th>Father's Name</th>
                <th>Mother's Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>HW</th>
                <?php if ($this->session->userdata('level') != 4): ?>
                    <th>Actions</th> <!-- New Action column only for levels other than 4 -->
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($children)) : ?>
                <?php foreach ($children as $child) : ?>
                    <tr>
                        <td><?php echo $child['child_name']; ?></td>
                        <td><?php echo $child['father_name']; ?></td>
                        <td><?php echo $child['mother_name']; ?></td>
                        <td><?php echo $child['gender']; ?></td>
                        <td><?php echo $child['dateofbirth']; ?></td>
                        <td><?php echo $child['health_worker_name']; ?></td>
                        <?php if ($this->session->userdata('level') != 4): ?>
                            <td>
                                <div class="action-icons">
                                    <a href="#" class="approve-icon" data-tooltip="Approved"></a>
                                    <a href="#" class="disapprove-icon" data-tooltip="Disapproved"></a>
                                    <a href="#" class="show-icon" data-tooltip="Show"></a>
                                </div>
                            </td> <!-- Action buttons -->
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">No child information found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

        </div>
    </div>
</div>
