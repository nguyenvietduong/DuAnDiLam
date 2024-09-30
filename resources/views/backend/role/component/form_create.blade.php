<!-- Your form or content goes here -->
<form id="addRoleForm">
    <!-- Example input fields -->
    <div class="mb-3">
        <label for="roleName" class="form-label">{{ __('messages.role.name') }}</label>
        <input type="text" class="form-control mb-1" id="roleName" name="name" placeholder="{{ __('messages.role.name') }}">
        <span class="text-danger" id="error-name"></span>
    </div>
    <!-- Add other input fields as needed -->

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">{{ __('messages.system.button.add') }}</button>
</form>