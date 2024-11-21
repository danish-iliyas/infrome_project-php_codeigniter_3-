<div class="assign-position-container">
    <h2>Assign Position</h2>
    <form action="<?php echo site_url('save_position'); ?>" method="post">
        <div class="form-group">
            <label for="position_name">Position Name</label>
            <input type="text" id="position_name" name="position_name" placeholder="Enter Position Name" required>
        </div>

        <div class="form-group">
            <label for="hierarchy_levels">Select Hierarchical Level</label>
            <select id="hierarchy_levels" name="hierarchy_levels" required>
                <option value="">Select Level</option>
                <?php foreach ($hierarchy_levels as $level): ?>
                    <option value="<?php echo $level['id']; ?>"><?php echo htmlspecialchars($level['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Save Position</button>
    </form>
</div>
