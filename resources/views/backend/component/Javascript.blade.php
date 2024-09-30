<script>
    // Encode your translation array as a JSON object
    const translations = @json(trans('messages.system', [], app()->getLocale()));
</script>

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
                icon: 'success',
                title: translations.successTitle, // ize according to your translations
                text: '{{ session('success') }}', // Flash message from session
            });
            
        } else if (type === 'error') {
            Swal.fire({
                icon: 'error',
                title: translations.errorTitle, // ize according to your translations
                text: '{{ session('error') }}', // Flash message from session
            });
        }
    }
</script>


<script src="/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/backend/assets/libs/simplebar/simplebar.min.js"></script>

<!-- Sweet-Alert  -->
<script src="/backend/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="/backend/assets/js/pages/sweet-alert.init.js"></script>

@stack('script')

{{-- <script src="/backend/assets/data/stock-prices.js"></script> --}}
<script src="/backend/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="/backend/assets/js/app.js"></script>
<script src="/backend/assets/custom/js/set-language.js"></script>
<script src="/backend/assets/custom/js/set-theme.js"></script>
<script src="/backend/assets/custom/js/set-slug.js"></script>
{{-- <script src="/backend/assets/custom/js/set-select_all_checkbox.js"></script> --}}
