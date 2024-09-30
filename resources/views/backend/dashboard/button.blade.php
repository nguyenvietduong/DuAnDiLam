@extends('layout.backend')

@section('adminContent')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Button and Confirm</h4>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <form id="userCreate" action="{{ route('admin.dashboard.button.post') }}" method="post">
                    @csrf
                    <button onclick="executeExample('handleDismiss', 'userCreate')" type="button" name="alertCustom" value="success" class="btn btn-success">Success</button>

                    <button onclick="executeExample('handleDismiss', 'userCreate')" type="button" name="alertCustom" value="error" class="btn btn-danger">Error</button>
                </form>
                <!--end card-header-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Alert</h4>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-header-->
                <div class="card-body pt-0">
                    <button type="button" class="btn btn-success btn-sm" onclick="executeExample('success')">Success</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="executeExample('error')">Error</button>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div><!-- container -->
@endsection
