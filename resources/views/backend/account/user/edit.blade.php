@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.button.update') }} {{ __('messages.account.' . $object . '.title') }} - {{ $user->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            <div class="col-lg-12 border-end">
                                @include('backend.account.user.component.form.edit_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script src="/backend/assets/custom/js/show_image.js"></script>
    @endpush
    @endsection
