@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.button.edit') . ' ' . __('messages.role.title') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            @include('backend.component.error')

            <div class="card">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">

                        <div class="col-lg-12 border-end">
                            <form id="myForm" class="p-4 pt-3" action="{{ route('admin.role.update', $role->id) }}" method="post">
                                @method('put')
                                @csrf

                                <div class="form-group">
                                    <label for="rolename" class="form-label">Role Name</label>
                                    <input type="text" class="form-control" id="rolename" name="name" value="{{ old('name', $role->name ?? '') }}" aria-describedby="emailHelp" placeholder="Enter rolename">
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.update') }}</button>

                                    <a href="{{ route('admin.role.index') }}"> <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
                                </div>

                            </form>
                            <!--end form-->
                        </div>
                        <!--end col-->
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->
@endsection
<script src="/assets_back/js/image.js"></script>
