function loadRoleCreate(url) {
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Reload table when reload button is clicked
        $('.btn.btn-secondary[type="button"][title="Reload"]').on('click', function () {
            table.ajax.reload(null, false); // Reload DataTable without resetting pagination
        });

        $('#addRoleForm').on('submit', function (e) {
            e.preventDefault();
            const formData = $(this).serialize(); // Serialize dữ liệu form

            $.ajax({
                url: url,
                type: 'POST',
                data: formData, // Sử dụng dữ liệu đã serialize
                success: function (response) {
                    if (response.success) {
                        executeExample('success'); // Gọi hàm thành công
                        // Sử dụng setTimeout để đảm bảo executeExample hoàn thành trước khi thực hiện các thao tác tiếp theo
                        setTimeout(function () {
                            $('#modal').modal('hide').on('hidden.bs.modal', function () {
                                $('.modal-backdrop').remove(); // Manually remove backdrop
                            });

                            // Trigger the click event on the reload button
                            $('.btn.btn-secondary[type="button"][title="Reload"]').click(); // Simulate a click
                        }, 2500);
                    } else {
                        console.log('Error: ' + response.message);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        executeExample('error'); // Gọi hàm thành công
                        setTimeout(function () {
                            $('.text-danger').text('');
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('#error-' + key).text(value[0]);
                            });
                        }, 2500);
                    } else {
                        console.log('An unexpected error occurred.');
                    }
                }
            });

            return false; // Ngăn chặn việc gửi form mặc định
        });
    });
}
