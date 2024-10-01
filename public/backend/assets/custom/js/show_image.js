document.addEventListener('DOMContentLoaded', function () {
    const imageInput        = document.getElementById('imageInput');
    const imagePreview      = document.getElementById('imagePreview');
    const imagePreviewOld   = imagePreview;

    imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    });

    
});