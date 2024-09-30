const selectAllCheckbox = document.getElementById('select-all');
const checkboxes = document.querySelectorAll('input[name="check"]');

// Function to update the "Select All" checkbox state
function updateSelectAll() {
    const checkedCount = document.querySelectorAll('input[name="check"]:checked').length;
    if (checkedCount === checkboxes.length) {
        selectAllCheckbox.checked = true;
        selectAllCheckbox.indeterminate = false;
    } else if (checkedCount > 0) {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = true;
    } else {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
    }
}

// When "Select All" checkbox is clicked
selectAllCheckbox.addEventListener('change', function () {
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
});

// When an individual checkbox is clicked
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        updateSelectAll();
    });
});