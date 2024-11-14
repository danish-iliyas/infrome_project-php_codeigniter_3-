
<script>
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