$(document).ready(function () {
    // Function to handle confirmation and submission
    function confirmAndSubmit() {
        $('.confirm-submit').click(function (e) {
            e.preventDefault(); // Prevent default action (like button click or link)

            var formId = $(this).data('form'); // Get form ID from data attribute
            var message = $(this).data('message')                   || "Are you sure you want to submit this form?"; // Default message
            var title = $(this).data('title')                       || "Are you sure?"; // Optional custom title
            var confirmButtonText = $(this).data('confirm-text')    || "Yes, submit!"; // Custom confirm button text
            var cancelButtonText = $(this).data('cancel-text')      || "Cancel"; // Custom cancel button text

            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: cancelButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    $('#' + formId).submit(); // Submit the form by ID
                }
            });
        });
    }

    // Initialize the function
    confirmAndSubmit();
});