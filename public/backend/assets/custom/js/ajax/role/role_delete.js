function loadRoleDelete(idTable) {
    $(document).ready(function () {
        // Attach click event to delete buttons
        $('.delete-role-btn').click(function () {
            const form = $(this).closest(idTable); // Get the form associated with the clicked button
            handleDelete(form); // Call the reusable delete function
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Reload table when reload button is clicked
    $('.btn.btn-secondary[type="button"][title="Reload"]').on('click', function () {
        table.ajax.reload(null, false); // Reload DataTable without resetting pagination
    });

    function handleDelete(form) {
        const url = form.attr('action'); // Get the action URL from the form

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-2'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: translations.button.confirm.title,
            text: translations.button.confirm.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: translations.button.confirm.confirmButtonText, // Using Laravel translation
            cancelButtonText: translations.button.confirm.cancelButtonText.button,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request to delete the role
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        executeExample('success'); // Call success function
                        // Use setTimeout to ensure executeExample completes before proceeding
                        setTimeout(function () {
                            // Trigger the click event on the reload button
                            $('.btn.btn-secondary[type="button"][title="Reload"]').click(); // Simulate a click
                        }, 2500);
                    },
                    error: function (xhr) {
                        // Handle error
                        Swal.fire('Error!', 'There was a problem deleting the role.', 'error');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    translations.button.confirm.cancelButtonText.title,
                    translations.button.confirm.cancelButtonText.text,
                    'error'
                );
            }
        });
    }
}
