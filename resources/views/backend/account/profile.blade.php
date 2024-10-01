@extends('layout.admin')

@section('adminContent')
    <div class="container-xxl">
        <!-- Profile Image and Edit -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="d-flex align-items-center flex-row flex-wrap">
                                    <div class="position-relative me-3">
                                        <!-- Profile image preview -->
                                        <img id="profileImagePreview" src="{{ checkMinioImage(Auth::user()->image) ?? '' }}"
                                            alt="Profile Image" height="120" width="120" class="rounded-circle">
                                        <a href="javascript:void(0);" id="changeImage"
                                            class="thumb-md d-flex align-items-center justify-content-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg">
                                            <i class="fas fa-camera"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold fs-22 mb-1">
                                            {{ Auth::user()->name ?? 'No data available' }}
                                        </h5>
                                        <p class="mb-0 text-muted fw-medium">
                                            {{ Auth::user()->email ?? 'No data available' }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Form to Update Profile Image -->
                                <form id="updateProfileImageForm" action="{{ route('profile.update.image') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*"
                                        style="display: none;">
                                    <button type="submit" id="uploadImageButton" class="btn btn-primary mt-2"
                                        style="display: none;">Upload Image</button>
                                </form>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

        @include('backend.component.error')

        <!-- Personal Information Form -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Personal Information</h4>
                            </div><!--end col-->
                            <div class="col-auto">
                                <a href="javascript:void(0);" id="editButton"
                                    class="float-end text-muted d-inline-flex text-decoration-underline">
                                    <i class="iconoir-edit-pencil fs-18 me-1"></i>Edit
                                </a>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <!-- Display Information -->
                        <div id="infoDisplay">
                            <ul class="list-unstyled mb-0">
                                <li class="mt-2"><i class="las la-briefcase me-2 text-secondary fs-22 align-middle"></i>
                                    <b> Fullname </b> : {{ Auth::user()->name ?? 'No data available' }}
                                </li>
                                <li class="mt-2"><i class="las la-phone me-2 text-secondary fs-22 align-middle"></i>
                                    <b> Phone </b> : {{ Auth::user()->phone ?? 'No data available' }}
                                </li>
                                <li class="mt-2"><i class="las la-envelope text-secondary fs-22 align-middle me-2"></i>
                                    <b> Email </b> : {{ Auth::user()->email ?? 'No data available' }}
                                </li>
                                <li class="mt-2"><i class="las la-university me-2 text-secondary fs-22 align-middle"></i>
                                    <b> Address </b> : {{ Auth::user()->address ?? 'No data available' }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Form -->
                        <form id="editForm" action="{{ route('profile.update') }}" method="post" style="display: none;">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Fullname</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ Auth::user()->address }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!-- container -->
    @include('backend.ajax.updates_the_profile_image')
@endsection
