<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLaybel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Added 'modal-dialog-centered' here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLaybel">{{ __('messages.system.button.addNew') }} {{ __('messages.' . $table_name . '.title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('backend.' . $table_name . '.component.form_create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.system.button.cancel') }}</button>
            </div>
        </div>
    </div>
</div>

