@extends('layout.backend')
@section('adminContent')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <h4 class="card-title">{{ __('messages.system.table.title') . ' ' . __('messages.account.' . $tableName . '.title') }} ({{ $totalRecords }})</h4>
                        </div>                        

                        <div class="col-auto ms-auto mt-1">
                            <a href="{{ route($linkCreate) }}">
                                <button type="button" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-plus me-1"></i>
                                    {{ __('messages.system.button.addNew') }}
                                </button>
                            </a>
                        </div>
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
@endpush
@endsection
