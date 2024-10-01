<!-- Encode translations -->
<script>
    const translations = @json(trans('messages.system', [], app()->getLocale()));

</script>

<!-- Check session flash messages -->
<script>
    $(document).ready(function() {
        // Check for session flash messages
        @if(session('success'))
        executeExample('success');
        @elseif(session('error'))
        executeExample('error');
        @endif
    });

    function executeExample(type) {
        if (type === 'success') {
            Swal.fire({
                icon: 'success'
                , title: translations.successTitle, // Use your translation
                text: '{{ session('
                success ') }}', // Flash message from session
            });
        } else if (type === 'error') {
            Swal.fire({
                icon: 'error'
                , title: translations.errorTitle, // Use your translation
                text: '{{ session('
                error ') }}', // Flash message from session
            });
        }
    }

</script>

<!-- Bootstrap v5 JS (after jQuery) -->
<script src="/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Additional JS libraries -->
<script src="/backend/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/backend/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="/backend/assets/js/pages/sweet-alert.init.js"></script>
<script src="/backend/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>

<!-- Custom Scripts -->
<script src="/backend/assets/js/app.js"></script>
<script src="/backend/assets/custom/js/set-language.js"></script>
<script src="/backend/assets/custom/js/set-theme.js"></script>
<script src="/backend/assets/custom/js/set-slug.js"></script>

@stack('script')
