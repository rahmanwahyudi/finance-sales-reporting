$(document).ready(function() {
    $('#accountManagersTable').DataTable({
        // Optionally, you can use AJAX to fetch data:
        // "ajax": "/path/to/fetch/account-managers",
        "processing": true,
        "serverSide": false,
        "paging": true,
        "searching": true,
    });

    // Add event listeners for edit and delete buttons here, if using AJAX
});