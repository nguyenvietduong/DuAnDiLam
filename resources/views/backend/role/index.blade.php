@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        @include('backend.component.title_table', [
                        'table_name'    => $table_name,
                        'total_records' => $totalRecords,
                        ])

                        @include('backend.component.button.button_add', [
                        'table_name'    => $table_name,
                        ])
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive">
                    <div class="container">
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
{{ $dataTable->scripts() }}
<script src="/backend/assets/custom/js/ajax/role/role_create.js"></script>
{{-- <script src="/backend/assets/custom/js/ajax/role/role_delete.js"></script> --}}
<script type="text/javascript">
    loadRoleCreate("{{ route('admin.role.store') }}")
    // loadRoleDelete('.delete-role-form')
</script>
@endpush
@endsection
