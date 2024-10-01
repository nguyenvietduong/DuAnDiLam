@extends('layout.backend')
@section('adminContent')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.button.create') }} {{ __('messages.' . $object . '.title') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            <div class="col-lg-12 border-end">
                                @include('backend.post.component.form.create_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')  
    <script src="/backend/assets/custom/js/show_image.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script defer>
        $(document).ready(function() {
            // Initialize Select2 with responsive width
            $('#tags').select2({
                width: '100%' // Ensure Select2 occupies full width
            });
            $('#categories').select2({
                width: '100%' // Ensure Select2 occupies full width
            });
            $('#friends').select2({
                width: '100%' // Ensure Select2 occupies full width
            });
        });

    </script>
    @endpush
    @endsection
