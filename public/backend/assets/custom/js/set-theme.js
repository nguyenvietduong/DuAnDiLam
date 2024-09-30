const themeToggle = document.getElementById('light-dark-mode');

themeToggle.addEventListener('click', function () {
    let currentTheme = document.documentElement.getAttribute('data-bs-theme');

    let newTheme = (currentTheme === 'light') ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme', newTheme);

    // Save to session
    fetch('/set-theme', {
        method: 'POST'
        , headers: {
            'Content-Type': 'application/json'
            , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
        , body: JSON.stringify({
            theme: newTheme
        })
    }).then(response => {
        if (response.ok) {
            // console.log('Theme updated successfully');
        } else {
            // console.error('Failed to update theme');
        }
    });
});
