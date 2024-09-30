<li class="dropdown">
    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <span class="fi {{ App::getLocale() === 'vi' ? 'fi-vn' : 'fi-us' }}"></span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-item" data-language="en">
            <span class="fi fi-us me-2"></span>{{ __('messages.language.english') }}
        </div>
        <div class="dropdown-item" data-language="vi">
            <span class="fi fi-vn me-2"></span>{{ __('messages.language.vietnamese') }}
        </div>
    </div>
</li>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                const language = this.getAttribute('data-language');

                // Send a request to change the language
                changeLanguage(language);
            });
        });
    });

    function changeLanguage(language) {
        // Use AJAX or a simple form submission to change the language
        // Here is a simple form submission example:
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/change-language'; // Set the correct route

        const languageInput = document.createElement('input');
        languageInput.type = 'hidden';
        languageInput.name = 'language';
        languageInput.value = language;

        form.appendChild(languageInput);
        document.body.appendChild(form);
        form.submit();
    }

</script>
