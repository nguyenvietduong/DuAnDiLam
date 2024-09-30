function loadRoleUpdate(url) {
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Sử dụng form để xử lý submit
        $('#editRoleForm').on('submit', function (e) {
            e.preventDefault(); // Ngăn chặn việc submit form mặc định
            const formData = $(this).serialize(); // Serialize dữ liệu form
            console.log(formData);
            

            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: url,
                type: 'PUT', // Phương thức PUT
                data: formData, // Gửi dữ liệu đã chuẩn bị
                success: function (response) {
                    if (response.success) {
                        // Gọi thông báo thành công
                        executeExample('success');

                        // Đóng modal sau khi thành công
                        setTimeout(function () {
                            $('#modalEdit').modal('hide'); // Ẩn modal
                            $('body').removeClass('modal-open'); // Xóa class 'modal-open'
                            $('.modal-backdrop').remove(); // Loại bỏ backdrop của modal

                            // Reload lại table hoặc thực hiện các hành động khác
                            $('.btn.btn-secondary[type="button"][title="Reload"]').click();
                        }, 1500); // Đợi 1.5 giây để hiển thị thông báo trước khi đóng
                    } else {
                        console.log('Error: ' + response.message);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        // Xử lý lỗi xác thực
                        executeExample('error');
                        $('.text-danger').text(''); // Xóa lỗi trước đó
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#error-' + key).text(value[0]); // Hiển thị lỗi
                        });
                    } else {
                        console.log('Đã xảy ra lỗi không mong muốn.');
                    }
                }
            });

            return false; // Ngăn chặn submit mặc định
        });
    });
}
