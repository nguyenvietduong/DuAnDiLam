@if(isset($table_name))
<div class="col-auto ms-auto mt-1">
    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modal">
        <i class="fas fa-edit"></i>
    </button>
</div>
@include('backend.component.modal.add_modal', [
    'table_name' => $table_name
])

@elseif(isset($link))
<div class="col-auto ms-auto mt-1">
    <a href="{{ $link }}">
        <button type="button" class="btn btn-primary w-100">
            <i class="fa-solid fa-plus me-1"></i>
            {{ __('messages.system.button.addNew') }}
        </button>
    </a>
</div>
@endif
